# WordPress Hardening Guide

## Web Server Rules
### Apache
- Keep `.htaccess` limited to standard WordPress rewrites.
- Block PHP execution in uploads. This repo includes `wp-content/uploads/.htaccess`:

```
<FilesMatch "\.(php|phtml|php5|php7)$">
    Require all denied
</FilesMatch>

<IfModule mod_php7.c>
    php_flag engine off
</IfModule>
```

### Nginx
Add this to the server block:

```
location ~* ^/wp-content/uploads/.*\.(php|phtml|php5|php7)$ {
    deny all;
}
```

## WordPress Config (example)
Update `wp-config.php` (never commit real secrets). The example file now includes:

- `DISALLOW_FILE_EDIT`
- `WP_DEBUG`, `WP_DEBUG_DISPLAY`, `WP_DEBUG_LOG`

## File Permissions
- Directories: `755`
- Files: `644`
- `wp-config.php`: `600` (server-only)

## Account and Access Controls
- Enforce 2FA for admin users.
- Rotate salts and DB credentials after a cleanup.
- Disable unused admin accounts and update admin passwords.

## Plugin/Theme Hygiene
- Remove unused themes and plugins.
- Avoid beta builds or file manager plugins in production.
- Keep all dependencies updated.

## Post-clean Checklist
- Scan uploads for PHP again after removing/quarantining.
- Verify WordPress core checksums.
- Inspect database options/users for anomalies.
- Review access logs for compromised accounts.
