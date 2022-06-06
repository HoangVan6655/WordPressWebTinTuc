<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'TinTuc' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '2Fh=Py5[O{XYjmG8/[kH!Sj#?~K$]>O:V9_F2YN5C;*S3=7C!7bH1d6fpV~|Yz6p' );
define( 'SECURE_AUTH_KEY',  'Wc`s%7/3H)=;=bfPe<]w2zP Wk+JZNKUjI>:28|Md.HIpEm{@EgJ)9C-9j}vDA}q' );
define( 'LOGGED_IN_KEY',    '_+.`E=g+,uR@Psg0-;Sc~:ArnZu,;;(-I|![9ipdG;do.rB~PifHgarOc;ztgB9f' );
define( 'NONCE_KEY',        '<OS0T4[^;Jw<oJA}T;@d?B>:ACo%c|a03Ys5c$wdBEIgp+phm2BhOEv_ppL:7~nF' );
define( 'AUTH_SALT',        'My6DMd@j4x{1/FvgbT,7.(Sr.a6p)Nt3;03zFZ8/H%[X)YuO@c1g}.s3/N9*ng?L' );
define( 'SECURE_AUTH_SALT', 'GzO`(;)(~Zk4<A:iC)MAter5vn+`=@|s$h*Du=T;U[>;ay|fm!VyA2~?Ly7XB>&x' );
define( 'LOGGED_IN_SALT',   '5Ef[(:9R{_su96:2,(1&Q=wy4`yNHbG3yg;&=RSN@@mYp6P#Me*~.Efe`7CqN:a:' );
define( 'NONCE_SALT',       'e{TSeK|C]L2kkV! A%Ku.#]djxWC!K?GcHs.s6+X/){f6JGth/]1`}8/L-}^jB=!' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
