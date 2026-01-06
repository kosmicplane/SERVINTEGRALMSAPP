#!/usr/bin/env python3
"""Security audit utilities for PHP/WordPress repos."""
from __future__ import annotations

import argparse
import hashlib
import json
import os
import re
import sys
from collections import Counter
from datetime import datetime
from pathlib import Path
from typing import Any, Dict, Iterable, List, Tuple

SUSPICIOUS_PATTERNS: List[Tuple[str, re.Pattern[str]]] = [
    ("eval", re.compile(r"\beval\s*\(")),
    ("assert", re.compile(r"\bassert\s*\(")),
    ("system", re.compile(r"\bsystem\s*\(")),
    ("shell_exec", re.compile(r"\bshell_exec\s*\(")),
    ("passthru", re.compile(r"\bpassthru\s*\(")),
    ("proc_open", re.compile(r"\bproc_open\s*\(")),
    ("popen", re.compile(r"\bpopen\s*\(")),
    ("base64_decode", re.compile(r"\bbase64_decode\s*\(")),
    ("gzinflate", re.compile(r"\bgzinflate\s*\(")),
    ("str_rot13", re.compile(r"\bstr_rot13\s*\(")),
    ("preg_replace_e", re.compile(r"preg_replace\s*\(.*?/e[\"']")),
    ("curl_exec", re.compile(r"\bcurl_exec\s*\(")),
    ("create_function", re.compile(r"\bcreate_function\s*\(")),
    ("chr_chain", re.compile(r"(?:\bchr\s*\(\s*\d+\s*\)\s*\.){3,}")),
    ("goto", re.compile(r"\bgoto\s+\w+")),
    ("ini_set", re.compile(r"@?ini_set\s*\(")),
]

SUSPICIOUS_FILENAMES = {
    "wso.php",
    "cmd.php",
    "shell.php",
    "up.php",
}

SUSPICIOUS_LOCATIONS = [
    re.compile(r"wp-content/.*/wp-login\.php$"),
    re.compile(r"wp-content/install\.php$"),
    re.compile(r"wp-content/.*/wp-config-sample\.php$"),
]

SKIP_DIRS = {".git", "drive", "node_modules", "vendor", "quarantine"}


def sha256_file(path: Path) -> str:
    hasher = hashlib.sha256()
    with path.open("rb") as handle:
        for chunk in iter(lambda: handle.read(1024 * 1024), b""):
            hasher.update(chunk)
    return hasher.hexdigest()


def iter_files(root: Path) -> Iterable[Path]:
    for current, dirs, files in os.walk(root):
        dirs[:] = [d for d in dirs if d not in SKIP_DIRS]
        for filename in files:
            yield Path(current) / filename


def is_php_file(path: Path) -> bool:
    return path.suffix.lower() in {".php", ".phtml", ".php5", ".php7"}


def read_text(path: Path, max_bytes: int = 2_000_000) -> str:
    try:
        data = path.read_bytes()
    except OSError:
        return ""
    if len(data) > max_bytes:
        data = data[:max_bytes]
    try:
        return data.decode("utf-8", errors="ignore")
    except UnicodeDecodeError:
        return data.decode("latin-1", errors="ignore")


def find_suspicious(path: Path) -> List[str]:
    text = read_text(path)
    matches: List[str] = []
    for name, pattern in SUSPICIOUS_PATTERNS:
        if pattern.search(text):
            matches.append(name)
    if re.search(r"curl_exec\s*\(.*(base64_decode|gzinflate|eval)", text, re.DOTALL):
        matches.append("curl_exec_payload")
    return sorted(set(matches))


def build_report(root: Path) -> Dict[str, Any]:
    findings: List[Dict[str, Any]] = []
    files_metadata: List[Tuple[int, float, str]] = []
    php_density: Counter[str] = Counter()

    for path in iter_files(root):
        try:
            stat = path.stat()
        except OSError:
            continue
        rel_path = str(path.relative_to(root))
        files_metadata.append((stat.st_size, stat.st_mtime, rel_path))

        if is_php_file(path):
            php_density[str(path.parent.relative_to(root))] += 1
            reasons: List[str] = []

            if path.name.lower() in SUSPICIOUS_FILENAMES:
                reasons.append("suspicious_filename")
            for pattern in SUSPICIOUS_LOCATIONS:
                if pattern.search(rel_path.replace("\\", "/")):
                    reasons.append("suspicious_location")
                    break
            if "wp-content/uploads" in rel_path.replace("\\", "/"):
                reasons.append("php_in_uploads")

            matches = find_suspicious(path)
            if matches:
                reasons.append("suspicious_code")

            if reasons:
                findings.append(
                    {
                        "path": rel_path,
                        "reasons": sorted(set(reasons)),
                        "matches": matches,
                        "sha256": sha256_file(path),
                        "size": stat.st_size,
                        "mtime": datetime.utcfromtimestamp(stat.st_mtime).isoformat() + "Z",
                    }
                )

    files_metadata.sort(key=lambda item: item[0], reverse=True)
    largest = files_metadata[:50]
    newest = sorted(files_metadata, key=lambda item: item[1], reverse=True)[:50]

    return {
        "generated_at": datetime.utcnow().isoformat() + "Z",
        "findings": findings,
        "stats": {
            "total_findings": len(findings),
            "top_50_largest": [
                {"path": path, "size": size} for size, _, path in largest
            ],
            "top_50_newest": [
                {
                    "path": path,
                    "mtime": datetime.utcfromtimestamp(mtime).isoformat() + "Z",
                }
                for _, mtime, path in newest
            ],
            "top_php_density": [
                {"path": path, "php_files": count}
                for path, count in php_density.most_common(50)
            ],
        },
    }


def write_markdown(report: Dict[str, Any], output: Path) -> None:
    lines = [
        "# Security Findings",
        "",
        f"Generated at: {report['generated_at']}",
        "",
        f"Total findings: {report['stats']['total_findings']}",
        "",
        "## Findings",
    ]
    if not report["findings"]:
        lines.append("No suspicious files detected by heuristics.")
    else:
        for finding in report["findings"]:
            lines.extend(
                [
                    f"- **{finding['path']}**",
                    f"  - Reasons: {', '.join(finding['reasons'])}",
                    f"  - Matches: {', '.join(finding['matches']) or 'None'}",
                    f"  - SHA256: {finding['sha256']}",
                    f"  - Size: {finding['size']} bytes",
                    f"  - MTime (UTC): {finding['mtime']}",
                ]
            )

    lines.extend(
        [
            "",
            "## Top 50 Largest Files",
        ]
    )
    for item in report["stats"]["top_50_largest"]:
        lines.append(f"- {item['path']}: {item['size']} bytes")

    lines.extend(
        [
            "",
            "## Top 50 Newest Files",
        ]
    )
    for item in report["stats"]["top_50_newest"]:
        lines.append(f"- {item['path']}: {item['mtime']}")

    lines.extend(
        [
            "",
            "## PHP Density (Top 50 Directories)",
        ]
    )
    for item in report["stats"]["top_php_density"]:
        lines.append(f"- {item['path']}: {item['php_files']} PHP files")

    output.write_text("\n".join(lines) + "\n", encoding="utf-8")


def main() -> int:
    parser = argparse.ArgumentParser(description="Run a security audit on the repo.")
    parser.add_argument("--root", default=".", help="Root path to scan")
    parser.add_argument(
        "--output-json",
        default="reports/security_findings.json",
        help="Output JSON report path",
    )
    parser.add_argument(
        "--output-md",
        default="reports/security_findings.md",
        help="Output Markdown report path",
    )
    args = parser.parse_args()

    root = Path(args.root).resolve()
    report = build_report(root)

    output_json = Path(args.output_json)
    output_json.parent.mkdir(parents=True, exist_ok=True)
    output_json.write_text(json.dumps(report, indent=2, sort_keys=True), encoding="utf-8")

    output_md = Path(args.output_md)
    output_md.parent.mkdir(parents=True, exist_ok=True)
    write_markdown(report, output_md)

    print(f"Findings: {report['stats']['total_findings']}")
    print(f"JSON report: {output_json}")
    print(f"Markdown report: {output_md}")
    return 0


if __name__ == "__main__":
    sys.exit(main())
