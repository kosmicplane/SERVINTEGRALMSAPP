# Security Report

## Summary
- Repository contained multiple PHP files inside `wp-content/uploads/`, a common malware persistence vector. These files were quarantined.
- Suspicious files in `wp-content/` (`install.php`, `cachef.php`) and empty PHP stubs at repo root were quarantined.
- Sensitive `wp-config.php` was removed from the repo to avoid credential exposure. A sanitized example remains in `wp-config.php.example`.
- Large logs/caches/backups were removed from version control to reduce attack surface and repo bloat.

## Quarantined Files (20260106)
The following files were moved to `quarantine/20260106/` for review:

- `wp-content/install.php` (unexpected installer file in wp-content)
- `wp-content/cachef.php` (obfuscated strings; prior infection marker)
- `test.php` (root test script)
- `printer.php` (empty stub)
- `prayer_intentions.php` (empty stub)
- `quiz_overview.php` (empty stub)
- `teasers.class.php` (empty stub)
- `wp-content/uploads/2019/wp-config-sample.php` (config sample in uploads)
- `wp-content/uploads/2024/03/themes.php` (PHP in uploads)
- `wp-content/uploads/mailchimp-for-wp/debug-log.php` (PHP in uploads)
- `wp-content/uploads/wpforms/cache/index.php` (PHP in uploads)
- `wp-content/uploads/2025/06/shortcode-for-current-date/**` (plugin-like PHP tree in uploads)
- `wp-content/uploads/gravity_forms/**.php` (randomized PHP filenames in uploads)

## Likely Attack Vectors (needs verification)
- **PHP in uploads**: common indicator of compromised plugins or weak upload validation.
- **Plugin/theme supply chain**: multiple plugins with historically high risk (file managers, beta builds) and many unused/duplicate features.
- **Exposed credentials**: `wp-config.php` was committed with real DB credentials and salts; remove from repo and rotate secrets on the server.

## Repository Cleanup
Removed from version control:
- `wp-content/debug_log`, `wp-content/error_log`
- `wp-content/ai1wm-backups`, `wp-content/et-cache`, `wp-content/wflogs`
- root `.cache`, `.center`

## Plugins Review (needs verification)
| Plugin | Purpose | Risk | Recommendation |
| --- | --- | --- | --- |
| aioseoextensions | All in One SEO extensions | Medium | **REMOVE** if not using AIOSEO core. |
| all-in-one-wp-migration | Site migration/backup | Medium | **KEEP** if used; otherwise remove to reduce backup exposure. |
| astra-sites | Starter templates | Low | **REMOVE** if not actively importing demos. |
| autodescription | SEO framework | Medium | **REMOVE** if using another SEO plugin. |
| classic-editor | Disable Gutenberg | Low | **KEEP/REMOVE** depending on editor choice. |
| classic-widgets | Disable block widgets | Low | **KEEP/REMOVE** depending on widget usage. |
| clever-fox | Theme companion | Medium | **REMOVE** if corresponding theme not active. |
| cloudflare-flexible-ssl | CF flexible SSL helper | Medium | **REMOVE** if not strictly needed; flexible SSL is discouraged. |
| contact-form-7 | Forms | Medium | **KEEP** if used; ensure updated. |
| darna-framework | Theme framework | Medium | **REMOVE** if Darna theme not active. |
| desert-companion | Theme companion | Medium | **REMOVE** if corresponding theme not active. |
| devvn-image-hotspot | Image hotspot widget | Low | **KEEP/REMOVE** depending on usage. |
| elementor | Page builder | Medium | **KEEP** if used; ensure updated. |
| elementor-beta | Beta build | High | **REMOVE** (beta builds increase risk). |
| gutenberg | Block editor plugin | Low | **REMOVE** unless explicitly needed. |
| image-optimization | Image optimization | Low | **KEEP/REMOVE** depending on usage. |
| integration-for-szamlazzhu-woocommerce | WooCommerce billing | Medium | **KEEP** only if WooCommerce billing needed. |
| js_composer | WPBakery builder | Medium | **REMOVE** if not used (duplicate builder). |
| limit-login-attempts-reloaded | Brute force protection | Low | **KEEP** (security). |
| mailchimp-for-wp | Mailchimp integration | Medium | **KEEP** if used; ensure updated. |
| norcon-common | Site-specific plugin | Medium | **KEEP** (custom). |
| norcon-elementor | Elementor addons | Medium | **KEEP** only if Elementor active. |
| one-click-demo-import | Demo import | Low | **REMOVE** after setup. |
| presto-player | Media player | Low | **KEEP/REMOVE** depending on usage. |
| really-simple-ssl | SSL helper | Medium | **KEEP** if still needed; consider native server config. |
| revslider | Slider Revolution | High | **UPDATE/REVIEW** (historically vulnerable). |
| seo-by-rank-math | SEO | Medium | **KEEP** if chosen SEO; remove other SEO plugins. |
| shortcode-for-current-date | Shortcode helper | High | **REMOVE** (found in uploads; suspicious). |
| simple-google-icalendar-widget | iCal widget | Low | **KEEP/REMOVE** depending on usage. |
| suremails | SMTP/mail | Medium | **REMOVE** if using wp-mail-smtp. |
| ultimate-addons-for-gutenberg | Gutenberg blocks | Low | **REMOVE** if Gutenberg not in use. |
| widget-importer-exporter | Widget import/export | Low | **REMOVE** after use. |
| wordpress-simple-paypal-shopping-cart | PayPal cart | Medium | **KEEP** if used; ensure updated. |
| wp-file-manager | File manager | High | **REMOVE** unless absolutely required. |
| wp-mail-smtp | SMTP | Medium | **KEEP** if used; remove other mail plugins. |
| wp-maximum-execution-time-exceeded | Runtime tweaks | Medium | **REMOVE** unless absolutely needed. |
| wpforms-lite | Forms | Medium | **REMOVE** if Contact Form 7 used (duplicate). |
| yoast-test-helper | Test helper | High | **REMOVE** (non-production). |

## Themes Review (needs verification)
| Theme | Purpose | Risk | Recommendation |
| --- | --- | --- | --- |
| Divi | Primary theme | Medium | **KEEP** if active; update regularly. |
| Twenty* (twentysixteen–twentytwentyfive) | Default WP themes | Low | **REMOVE** if not used. |
| Astra / Neve / other vendor themes | Alternate themes | Low/Medium | **REMOVE** if unused to reduce attack surface. |
| Norcon / Darna / other custom themes | Site-specific | Medium | **KEEP** if used; remove unused duplicates. |

## Database Checks (post-clean)
- Inspect `wp_options` for unknown cron jobs, injected autoload options, or base64 blobs.
- Verify admin users in `wp_users` and `wp_usermeta` for unauthorized accounts.
- Review `wp_posts` for hidden PHP in content (especially in reusable blocks).

## Notes
- The audit reports are in `reports/security_findings.md` and `reports/security_findings.json`.
- Files in `quarantine/` require manual review before permanent deletion.
