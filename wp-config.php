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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp56' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'U[I&`y|O(^d*Ew,w^IR~O>L[TQV_q!yO&e+8nzD&AF/ZElNQo<.&Iku6Fq!t/k>R' );
define( 'SECURE_AUTH_KEY',  'gFn-U^&*rJj<@{>?>#Q1biAU9hb7N!Vf+a:RPbl`/#_wRVA{$dDAX+=tY16CF=C;' );
define( 'LOGGED_IN_KEY',    'f`d)U~QSTXAG0MB 8>dv{Lo~LJ,K3QOh E[z1&|$)Js(@HHm=4*U=x];Z4M >}3k' );
define( 'NONCE_KEY',        '3iBR,[F<No0|pz1s1FkXuPB11 OT4DZ53mQB~oVn,0/XSG=z8$c~KC<&Y:M:iGTv' );
define( 'AUTH_SALT',        'rttuv8k7 l%LDzIDF9yb(`TJtbe+lB}b>4#?OIm<.<-1Pi9CUyIs=O?^_^xu`aX ' );
define( 'SECURE_AUTH_SALT', 'KRAuW,&z>0)8`0Vwf{-6=Z4-v]z+wyC%C@|,%n:z1_hNc0z9H, 5W&qhdCu>r~1M' );
define( 'LOGGED_IN_SALT',   'jC;jl{b=|7H|oW ]bL%@|yU<(@~)[L|?c+&<9}+o+rrM~7;6_VE62b`Kz;C=jHh`' );
define( 'NONCE_SALT',       'M_0gDlM|@Rb^>>^LupJqEr| Fm6y3F6%b}Li]NODDY5rfVjixE@84+BO/nYpi@>>' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
