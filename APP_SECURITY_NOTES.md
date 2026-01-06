# App Security Notes

## Password Storage (MD5)
- `app/libs/php/users.php` uses `md5()` for password hashing and reset codes.
- Recommendation: migrate to `password_hash()`/`password_verify()` with a phased rollout:
  1. Accept legacy MD5 hashes on login.
  2. Rehash using `password_hash()` after successful auth.
  3. Remove MD5 support once all users are migrated.

## Recursive Deletes / File Cleanup
- `app/libs/php/users.php` includes `delDir($path)` used for order-related cleanup.
  - Ensure `$path` is derived from a fixed base directory and validate with `realpath()` + allowlist checks.
- `app/loadOrder.php`, `app/loadBudget.php`, `app/loadEnd.php`, and `app/loadIni.php` delete files via `glob()` + `unlink()`.
  - Confirm the target directory is fixed and not influenced by user input.

## Dynamic Execution Review
- No direct `eval()` or dynamic includes were found in `app/` by heuristic scan, but review any request routing that maps user input to class/method execution.
- If dynamic dispatch exists, enforce an explicit allowlist of controllers/methods.

## Dependency Hygiene
- `app/libs/phpExcel` is legacy and contains insecure patterns for modern PHP. Consider upgrading to PhpSpreadsheet and removing example scripts from production deployments.

## Next Steps (non-code)
- Add centralized input validation for any endpoints that accept file paths.
- Add rate limiting and CSRF protections for administrative routes.
