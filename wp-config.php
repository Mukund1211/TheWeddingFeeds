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
define( 'DB_NAME', 'theweddingfeeds' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'IqErrbPs:j$;gJs%x{jlF7#M|07q+p@[zPZ5yk8|&c)EZB/nlhl9HGgdnX|P`h/P' );
define( 'SECURE_AUTH_KEY',  '8l3+2Sr:P*]iW229u183W@CqN)bP6aJL#dS#ET&HGoW5(PIR!11H%8(<xGrxMV3;' );
define( 'LOGGED_IN_KEY',    'bqYh@)F-vy^*Ihp-o=HJLl:.)Yv{,9Y6=m){<Fxxj >y|I&x}4:&|}19SQ+8hoeX' );
define( 'NONCE_KEY',        '^;lN1rFm>vmP&ewLTX=<4rto%*[*]Lv=)@#:~sAHxJ}8B&TPXt|A_h}5}$Gg3MFK' );
define( 'AUTH_SALT',        'TyS._SA@<3gkBB~$yOO?/jFZ8XhF,Lb/|8a<bln37#EiR%{j40d](Qi`+s xI|?o' );
define( 'SECURE_AUTH_SALT', 'PLoX+YU7SvK.o#@n.pGUIk5.l$;f>_H.K%+:^#/tnMBs{DfGzP(9%.lmjMJ.4OeO' );
define( 'LOGGED_IN_SALT',   'pqh10K%pZ&<>09P^dELf)s(uFw^y$eqp.V9]v.d6;nHR@N#2e;,*V%>2PChO`2Y0' );
define( 'NONCE_SALT',       '+,oAf*,qj[+Ey`o sS/%a+?V!|~Wf28/numcH&Kqc%5#p]]YX_*88vYe3t_zmbz5' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'twf_';

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
