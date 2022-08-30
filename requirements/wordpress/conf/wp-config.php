<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

if (!function_exists('getenv_docker')) {
    function getenv_docker($env, $default) {
        // if ($fileEnv = getenv($env . '_FILE')) {
        //     return rtrim(file_get_contents($fileEnv), "\r\n");
        if (($val = getenv($env)) !== false) {
            return $val;
        } else {
            return $default;
        }
    }
}

define( 'WP_CACHE', true);
//Salt for the cache objects, site-url, replace dot and forward slash with dash
define( 'WP_CACHE_KEY_SALT', getenv_docker('WP_REDIS_CACHE_KEY_SALT' , 'mathmart.42Lyon.fr') );
//IP or hostname of the target server. Either app/container name, i.e. redis1 or localhost
define( 'WP_REDIS_HOST', getenv_docker('WP_CACHE_REDIS_HOST', 'redis') );
// Either the default 6379 when using appName as host or 30xxx port number found in app quick view
define( 'WP_REDIS_PORT', getenv_docker('WP_CACHE_REDIS_PORT','6379' ) );
//either not set as there is no password by default for Redis, or if you changed redis password, set it here

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv_docker('WORDPRESS_DB_NAME', 'mysql') );

/** MySQL database username */
define( 'DB_USER', getenv_docker('WORDPRESS_DB_USER', 'example username') );

/** MySQL database password */
define( 'DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'example password') );

/** MySQL hostname */
define( 'DB_HOST', getenv_docker('WORDPRESS_DB_HOST', 'mariadb') );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', getenv_docker('WORDPRESS_DB_CHARSET', 'utf8') );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv_docker('WORDPRESS_DB_COLLATE', '') );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8$ZL wY,[.^CR%b@>+!U7P|VZ[-I&@@aGP9LV9-R~j%VnS-P|nyZ+4bYKQ6HJ)Te');
define('SECURE_AUTH_KEY',  'Fy,^qSdO#jkBhVZpl(+sN[3f:%C=Oych~}}&S~G{a8zn0^5ms7 U<qv5#(Nj<?74');
define('LOGGED_IN_KEY',    '@FTf4K2wEyFuc{W5@yw `lQJs17yK+3KWdAc)Golgk:oBht}~4(|!y[>kl]`4%hD');
define('NONCE_KEY',        '0le!<=Q6-:qWk,e#+w2,xnsiB}){*Qou6,RaO:B4-VVhr`8&W;a61]XY;yu@b-uE');
define('AUTH_SALT',        'J}tc`aY|Pff|$ShP>&.XI{H-);=*$Nseqt,e3!`j]H-JG9pDST&++1gw]o6{4UC+');
define('SECURE_AUTH_SALT', '2dZ<j@n$kcsffL]BU-U~7*eAa+&X)l@<}m KgA<KSNQ]S)KrC^VY8dV5_qLgnxt-');
define('LOGGED_IN_SALT',   ':G>A%cJA0L<o*;(+r@WR.O)4Ezc|(:3+wkRBI_,DDlAH?24iIgWGxz&&TTrIA0)Y');
define('NONCE_SALT',       '/p{a<0=MHncbF@C0a`$6Og1Vag_&W!gKgfA>V;pz]b~8Ci):NErr/[)]V$42Z>Ed');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */

$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wb_');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */

define( 'WP_DEBUG', !!getenv_docker('WORDPRESS_DEBUG', '') );

if ($configExtra = getenv_docker('WORDPRESS_CONFIG_EXTRA', '')) {
	eval($configExtra);
}

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
