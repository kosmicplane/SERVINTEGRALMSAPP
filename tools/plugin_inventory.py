#!/usr/bin/env python3
"""Inventory WordPress plugins and themes."""
from __future__ import annotations

import argparse
import json
from pathlib import Path
from typing import Dict, List, Optional


def read_header_value(lines: List[str], key: str) -> Optional[str]:
    prefix = f"{key}:"
    for line in lines:
        if line.lower().startswith(prefix.lower()):
            return line.split(":", 1)[1].strip()
    return None


def read_plugin_header(path: Path) -> Dict[str, Optional[str]]:
    try:
        content = path.read_text(encoding="utf-8", errors="ignore")
    except OSError:
        return {"name": None, "version": None}
    lines = content.splitlines()[:50]
    return {
        "name": read_header_value(lines, "Plugin Name"),
        "version": read_header_value(lines, "Version"),
    }


def read_theme_header(path: Path) -> Dict[str, Optional[str]]:
    try:
        content = path.read_text(encoding="utf-8", errors="ignore")
    except OSError:
        return {"name": None, "version": None}
    lines = content.splitlines()[:50]
    return {
        "name": read_header_value(lines, "Theme Name"),
        "version": read_header_value(lines, "Version"),
    }


def read_readme(path: Path) -> Dict[str, Optional[str]]:
    try:
        content = path.read_text(encoding="utf-8", errors="ignore")
    except OSError:
        return {"name": None, "version": None}
    lines = content.splitlines()[:200]
    return {
        "name": read_header_value(lines, "Plugin Name")
        or read_header_value(lines, "Theme Name"),
        "version": read_header_value(lines, "Version"),
    }


def inventory_plugins(base: Path) -> List[Dict[str, Optional[str]]]:
    plugins: List[Dict[str, Optional[str]]] = []
    if not base.exists():
        return plugins
    for plugin_dir in sorted(p for p in base.iterdir() if p.is_dir()):
        readme = plugin_dir / "readme.txt"
        meta = read_readme(readme) if readme.exists() else {"name": None, "version": None}
        if not meta.get("name"):
            for php_file in plugin_dir.glob("*.php"):
                header = read_plugin_header(php_file)
                if header.get("name"):
                    meta = header
                    break
        plugins.append(
            {
                "path": str(plugin_dir),
                "name": meta.get("name"),
                "version": meta.get("version"),
            }
        )
    return plugins


def inventory_themes(base: Path) -> List[Dict[str, Optional[str]]]:
    themes: List[Dict[str, Optional[str]]] = []
    if not base.exists():
        return themes
    for theme_dir in sorted(t for t in base.iterdir() if t.is_dir()):
        style_css = theme_dir / "style.css"
        meta = read_theme_header(style_css) if style_css.exists() else {"name": None, "version": None}
        if not meta.get("name"):
            readme = theme_dir / "readme.txt"
            meta = read_readme(readme) if readme.exists() else meta
        themes.append(
            {
                "path": str(theme_dir),
                "name": meta.get("name"),
                "version": meta.get("version"),
            }
        )
    return themes


def main() -> int:
    parser = argparse.ArgumentParser(description="List WordPress plugins and themes.")
    parser.add_argument("--root", default=".", help="Repo root")
    parser.add_argument("--json", action="store_true", help="Output JSON")
    args = parser.parse_args()

    root = Path(args.root)
    plugins = inventory_plugins(root / "wp-content" / "plugins")
    themes = inventory_themes(root / "wp-content" / "themes")

    if args.json:
        print(json.dumps({"plugins": plugins, "themes": themes}, indent=2))
    else:
        print("Plugins:")
        for plugin in plugins:
            print(f"- {plugin['path']} | {plugin['name'] or 'Unknown'} | {plugin['version'] or 'Unknown'}")
        print("\nThemes:")
        for theme in themes:
            print(f"- {theme['path']} | {theme['name'] or 'Unknown'} | {theme['version'] or 'Unknown'}")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
