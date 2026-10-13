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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'damaswebistedev_wp_9xjth' );

/** Database username */
define( 'DB_USER', 'damaswebistedev_wp_67xmg' );

/** Database password */
define( 'DB_PASSWORD', '!Q7^rk6PPH8Ivudf' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY', '#9bYx)qM%c79C3P0Z]|~ne#1x9dM)%ja~J;9-4j53cLV!d76BXC_Hf~_x#y8rOx6');
define('SECURE_AUTH_KEY', 'FB8z_nt1wU51igQ15JcGijcA84@Pc2Ncc%NrYIehK8KC9~Z3DJei43J*57*99_&E');
define('LOGGED_IN_KEY', '5T_N6jR|2@bF1X85&R5uS4vtYZQ6/E*8vOu]-F_A%vO!7R0ov5%!]ZS#0j)R#5k1');
define('NONCE_KEY', '400P)UyE&1NJoj8499y2_1&8~x9qH1-Pc8#52I0#i9#ZUu[O%f*eF29!h2]6Qg8m');
define('AUTH_SALT', '1b]lA2cE3(47~Z2Kxd(3Oi1~al:D1/U7b9FKYk0S*18DK~W9%f2[;aWeSl/QM9Hh');
define('SECURE_AUTH_SALT', '!ZTC!;SMAQ2VVZ&!#H6FwaB4+z:_GrBZzh#552Ll1Mt2+D_1-3j@c6b92LBoLdaQ');
define('LOGGED_IN_SALT', 'd499fOp5#;/91jF0669Dk;OxpQQ]@AAG-hF97:]Pz-i7Ug#ply%G8O4TlcA1*[/O');
define('NONCE_SALT', '-S*)w*1o~wkknZS~02ta0RgErN/)&J71/Zc3dj)rJ3066;C9;/HD+HVl3G3PZ6i~');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'btnv7z_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
