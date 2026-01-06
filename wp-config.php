<?php
//Begin Really Simple Security session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple Security cookie settings

//Begin Really Simple Security key
define('RSSSL_KEY', 'IrPC8lAxcCWmu3pCunaUKowja94dlWpntqyIiTnWb8BsVhGGJGh3xWYl0H4Kk2Lq');
//END Really Simple Security key

/**
 * The base configuration for WordPress
 *
 * @package WordPress
 */

// ** Database settings ** //
define( 'DB_NAME', 'i9042225_wp1' );
define( 'DB_USER', 'i9042225_wp1' );
define( 'DB_PASSWORD', 'Y.TckupOXVjuV6Ou3QO36' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 */
define('AUTH_KEY',         ' <Ky{OG9(E~n*mGU OEQXO|b&1]TMksz;FqR.v4/JNuMIQ;wX:+kk!$QF:13Uqt~');
define('SECURE_AUTH_KEY',  'iTA7>K&5Cp/>w`1 )/Fmo%hD>=wSJO;`+|upn=+&bOYXactWp47GB(j)q{nnuc)>');
define('LOGGED_IN_KEY',    '5(JHkTBY^. 9h][w8zQ}b{eU_a]`8+A6Nnxnp-_~F%Z[>sXNA+cm6h8]z?i tO/~');
define('NONCE_KEY',        'UN_M(Jt;Hyl|AyY>loF3&pEoM;1)Blqd9/w!hS;N?c1c:nn5X+45F4J j?Z-|Zzv');
define('AUTH_SALT',        'M(wB&&KiJ4)`)E&G. -}s6zKkk&atOPe%)E%d%})Kd*hbW5Bq&a?XGL`qc@UhPg7');
define('SECURE_AUTH_SALT', '6qi.Z{jYB{u` h:/C[kc|PQ&d[|wTm[|aJj1T0/Wq-)6L9e1B16]Wn>2&Y31_P,|');
define('LOGGED_IN_SALT',   '?g@jV)?AAM+ciX@C%Sj;4>Zoc*Vg.pf3~o?&eq7?d7w<NpJwG6+8sDUF2aZ}z8Si');
define('NONCE_SALT',       'f1-;,_5(u-W8B<+R}-G-O~M^M|Mx@XIBG]+-^*5/#B&}|Q5i^kD <})WexOdG--0');
/**#@-*/

// Configuraciones adicionales
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR', dirname(__FILE__).'/wp-content/uploads');

// Prefijo de tablas
$table_prefix = 'wp_';

// Debug
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', true);
define('WP_MEMORY_LIMIT', '512M');
define('WP_MAX_MEMORY_LIMIT', '768M');
set_time_limit(300);
/* ¡Eso es todo, deja de editar! Feliz publicación. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
