<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '~k4sS9v(~Q._qF6oc>/-Y]6V-Kn*e7{[5_Tz#Bjb/;qZm==FOrF89NFmJg|} 7h$');
define('SECURE_AUTH_KEY',  'ZYjK&,IFCvx{|!tNO%3iB]/xk+t#dU6O:~`)b;A`$6?moRZJg1gM]X4D_=~Vyl}9');
define('LOGGED_IN_KEY',    'jl8)m@TOt_#!|8Ao1U5/cu,gf{,D*m~FNX^km6Ql*3!,<0P4}6#W8s;@-+jFtlZE');
define('NONCE_KEY',        'on:EFhOKkQ@-r_p(-2,:vx:~(&7j.0HkC[4@;4O~70FMm_~iI-x`9bYF)D=?gqL0');
define('AUTH_SALT',        'v`UxK(]2&?g:q-xu=n{{Z3f^>;Cg5%7@ke?m+G,xpNo?ao| c*zCo#3_HW{XsU#/');
define('SECURE_AUTH_SALT', ')4N;|B1D@]!l)KCNj]yYSeL>If+f)OJA#Gw)h0/ADde(+H{ydP6lJ@>P>Hy;nB[L');
define('LOGGED_IN_SALT',   '%0Qq:9/6]uR?s}O(uMSobIqvcN3E4|H1an]Zi%F(?[QcfN7Uw_3?k:{`c+@ybgTT');
define('NONCE_SALT',       ';H;~St.c$~Hz|eMqP2f[w|~.$JXa+Kh5rLU2E8SMiz}t.`e_wbE!(4.WF,2jEkvL');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
