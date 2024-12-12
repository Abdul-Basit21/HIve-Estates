<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hive_estates' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'admin123' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FS_METHOD', 'direct');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '?lo`qM{Mp=gq{Oh3e}viiQ#D9pZ_Y@*o)O<<PkQ[asos..$7aMP1O8J3/VxYU,sa' );
define( 'SECURE_AUTH_KEY',  'w/~9nOpuu(L=F%aUz#m{ah{euRTa2$[gXk }4YU@DUX!D#RQE3j#* ~;pxK2R={n' );
define( 'LOGGED_IN_KEY',    'K<6r$m-w} j.BMu $id+f0a:iH3,C[zx@~O}CZJ+ShC:+}>q:K!U ;c;Em|B5~G#' );
define( 'NONCE_KEY',        'l+CMr<jC2|L88@tv?H@q7es#Z}dT(~I(1&a K&D<3TG9_99/IOGUb&Y Ce-!0:N{' );
define( 'AUTH_SALT',        'y8LFn!x=+*Vp4N+vOd~RyOrjH g#{<t_lwv&rv2.Y#-s.ht@>Wl?ihu<eOOwDrzd' );
define( 'SECURE_AUTH_SALT', ';#).J<HZi<?!x*E5JEcEAl05PW<$cKxOI+iGI?.]ejiK^1Ogz^/t8iXjp o|,V%,' );
define( 'LOGGED_IN_SALT',   '%9ktYY,%_)gW:K>)vk-zsD..`c /HLIUIZO=&H/e1U6+35>cog]sH)://VL-8l{}' );
define( 'NONCE_SALT',       'g+V,k@KKUsk3p|dOCwV`7$%MR=UZI;GD{TzKx9n cN:pq||M!>Qh1Vh{^Jt%^YZ3' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
