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
define('DB_NAME', 'central');
define('DB_USER', 'central');
define('DB_PASSWORD', '######');
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '+AI$3D;f}8f8cl6/u7M{pIiv`t0N<J+?zZKUe1(-&-e,v^p9--+xplPT*H<]_YUo');
define('SECURE_AUTH_KEY',  '>HoeQ.AkI3CEl^-a)Os$<_^#Lx-$# ~x4+s,T,<=?w}fUf^spk^ @d&O{b`Rwrg`');
define('LOGGED_IN_KEY',    'rs+3U<7!BY4/qZ|K2v_}~zTH]K#PADDJ(]S91^yFmc!3!vdS+NoQ0Q3Ln])@2.Mc');
define('NONCE_KEY',        'F`#yxZys(9SM+?13.VcG>oW`&-d&K/B)P^@@rN%b;Z;~>R@ Q3H!T hU|Zc5Br(8');
define('AUTH_SALT',        'V -_l-]B&Y%37U`H*-Yh6Ggbd<)-|zIk=mu/salrZDippX22N,r<*U#fEg%e` ]^');
define('SECURE_AUTH_SALT', '3l6H+dn=Dyr{ad|k{g+4J:P4J H-:FeDtaF/<$FqQQl?qr Ltb,qw!m_4~rPhU(W');
define('LOGGED_IN_SALT',   'WYU~rfW7J|-(pam |DsSCju <0!NQF>t7k?q?Um.%Z*Dr]Vt(&UDe{7n}409& 0_');
define('NONCE_SALT',       'Z2B-Y1=nK*Ty}>S-m-y8ZW| s,GHLbF7G4~l%@Eo(^aK[2?z|krh9]KIbK}>~pA+');
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
