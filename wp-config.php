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
define('DB_NAME', 'marine_whitelist');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1:3306');

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
define('AUTH_KEY',         'asL%@>%h03e@+]Rv?4i-?4wsnPxWY}aUuON]|:X$}Ul QIws#&W}9:/yO|2RMm0n');
define('SECURE_AUTH_KEY',  'k+5,bJkmIWN&_@HL<^pR<*B.!_c>fw<m|mQ<vocN?n7nBN=s7-f-EYVj^b5Z-BRn');
define('LOGGED_IN_KEY',    '}SANS*Q|*liFn=jmhrt)(+|.AH2+9b3fH|o`TxR0+U&ymO)+$<4dW|;frf1lo_Ao');
define('NONCE_KEY',        'C6mSc^6O  $+aF<g-7#]Oiy]6f;aD~v4_6aUfBoI=7^gB(Sn>9DS_*EdwUJX,Rwi');
define('AUTH_SALT',        '8jDi+3eSrNP~]wPYs>Z,--;u+Y!y*BZN)Fx-sYL^;D0#h[(buwD3E )#w9K<.j5p');
define('SECURE_AUTH_SALT', '}mATT,+NnK5+Q|zqiJGK/f(Ls-oZ2au*u?+rVi}v#6R^/`kP8w{,2iXcb]U`x({w');
define('LOGGED_IN_SALT',   'ffdn;4l)eIpHtte ESk2: -L[yV+Pc!|x[M>#+nPxhBxF+%kuG0OLWq_cHrfK*re');
define('NONCE_SALT',       'KE(9!,z|{|Bu4^iZBQ=p)B82bOrc6<(I&y_/J9;k%pLOA!k-.sI_2Q0)Jv{)kzo`');

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
