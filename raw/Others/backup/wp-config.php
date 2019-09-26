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
define( 'DB_NAME', 'dailyhom_web' );

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
define( 'AUTH_KEY',         ',WvEGtn;f+Dtk{0X8j<3k0nzOf<,k{tT^DM@:zI0j/{;7M@/(o!hdEkJp6Tl!Y9W' );
define( 'SECURE_AUTH_KEY',  'SOiQ;7X@[mYqoUs4>uA:<LLtP.ZZ5RTQ-{C;lbw%-NiTOJ=-j|4Evd{5Uqwbm;sS' );
define( 'LOGGED_IN_KEY',    'YV]}*$Q1>j&r|0#IQKf!?W`B3}jM8](3*#J,~qV/v&LMN@yaAl0X$R#Q,TxL !3a' );
define( 'NONCE_KEY',        '17Ev8eZu%Oda^g%j@1$dp2VLX99r{D4y<n5l]+lNu@.ZQ/F&Awx>?x[<<sq6D,C^' );
define( 'AUTH_SALT',        'V!`Pci~>gon!2` mk[eyI1v#86{e4mP$UKFT2}(uDfKS/%[CGx8JC(n ox[*o&^5' );
define( 'SECURE_AUTH_SALT', '-_C.LGDv8j7S>>Mw-$<UE*Yw9)<GMYms_:q~.~?_z}9#Ns7jl5XI0]Er.vrG_ia&' );
define( 'LOGGED_IN_SALT',   '}QzClf:y;p%<-}r[~zt?*Wk%m3G2~w4ncfrbx84?tbr#p2o&1n|QMN.o&l<C-d-{' );
define( 'NONCE_SALT',       'hMB)ezP;P@LfYy ,Dm^4+!zoK6&eptKGbP oK[PXU@*sL,p/t_~^tSuCm?HyC_%N' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
