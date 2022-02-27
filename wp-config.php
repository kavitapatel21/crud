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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'crud' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '{_X<dsnD7ef>e;).&2k2zHMd!nD0Bf3Rf8^m1@UDWKQ+5T+al0`t0pbUXFwcJn|}' );
define( 'SECURE_AUTH_KEY',  'xTo^[&xyRiVZQaAZafUsqlY7u%hcpp+ ={>Bst2-&wT@$)6R^Zt$c_N[rB_|tK*N' );
define( 'LOGGED_IN_KEY',    'doX19@o&o`KPm25n{+hJcoE[%y7PL(C;NlWZrZ2vw_pu )#X;mO,ki!o^3|ZYZcP' );
define( 'NONCE_KEY',        'eV>#`!^d2!{W_pC6Ki)F8vrK4zaB0MUCZwIhpk(@y0ywgA?=jrvH_8rR6^w@;bN5' );
define( 'AUTH_SALT',        'r,%=D<,+7T~R9.{eY8GfggeX7[)cLs0 $=HHbp1S{s8.nopTpCl5s+g(E:#Cjm,N' );
define( 'SECURE_AUTH_SALT', 'fF[@%j:5EB,EXN+ON/~uD?Y-Md:(,^$,/W}0K2mS[]69lRd|!h66Cd6V<!UGS+X0' );
define( 'LOGGED_IN_SALT',   '|*l2.I&dZb|z}hcpxpI]>H)?8xj2mvD;9?Kg=Tm[.BPcWvGQ*bM]NP(5%c>GK-b@' );
define( 'NONCE_SALT',       'heinK1yeYS3u*Vz6>s2^-(qSar]cPDk.<cRfUk0n1Ep/+W$@8r:b)UABl_5&=`jh' );

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
