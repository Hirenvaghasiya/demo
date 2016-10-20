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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'demo_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'z=T[GtN/furJRX}mh*LfW.NLFKN+5V9GD$Pdd:K[e0o?*I#jf8,pO6DUeo/j$JwJ');
define('SECURE_AUTH_KEY',  'c8V}ye816T`:*k2>@g}5oB{T|??:c;+/ZcQqz^DG9 7/nT_rXD~F5 n%<?we iI2');
define('LOGGED_IN_KEY',    '1Pnb<p$ZQBzWf)FJSOISd4Xsnm ofBKzFDrFsbf(G}Lkl@UA=n3nlPG~#0T`Y4N(');
define('NONCE_KEY',        '=})D1zpqU@cuuxu;sczJY06ShyOcham1::jqOhXozS__bVA8oc|kbJLCy9f>iJe$');
define('AUTH_SALT',        '{GpA`yjN0OY8D]e@T7G r@QZvu}ab7JS}i}Wsi<@J}6HaM.FijDZ)~>nA %+&U[7');
define('SECURE_AUTH_SALT', '`6a~`,,f~(4{Ca.HnmoGLl6*I{2U;F%V}H{Xnm*S(&|t*+ *qgu_])#d>qUsH|JY');
define('LOGGED_IN_SALT',   'R(<txvRWR`g=Qh397OnP%R9 U}sTDNI~;Af<[z7dLJ9Rb1|+*hR;zN8Cf>X$@TiR');
define('NONCE_SALT',       'F{yLn5KR*fCrenC9#ZK3u+)U6%30I}%xx|G(TDP5fT=mhw4h0IxZ1O@}`@xa_PS+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
