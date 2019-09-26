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
define('DB_NAME', 'comfort_web');

/** MySQL database username */
define('DB_USER', 'comfort_web');

/** MySQL database password */
define('DB_PASSWORD', 'salahuddin2012');

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
define('AUTH_KEY',         '^Za8h{8d-D?OOGkp{|=u2rH;!t=}?JB69PP]pXu}QOF_W%l@b*MQ(q</8Ua?UO-j');
define('SECURE_AUTH_KEY',  'iC/8(05)~ZZsL*7&7NM5.HTlLBhUY!03VWQ1z(,/C`O5;0 @;h!fbC9U!]!BOZ,E');
define('LOGGED_IN_KEY',    'Kj-%NPF0-{Zmp#$#EAwfA-UA4{aDR?aqEn/fG/.ZhQ+y}g{KNtpYEH0db&wPotNi');
define('NONCE_KEY',        '=+a_gO/,bdRVqR&x@<~!FBu,L$_9Y;s,&:K!#Ue $l}y3D@/Nr9+$Vz{q&-5^TxH');
define('AUTH_SALT',        'z>ho~S?`e,!jb;moaLtFC4RK@IKP*.P@x_IOt+*;`q>RRm/z47bQQ8j{lBF@cGna');
define('SECURE_AUTH_SALT', '^[+77KmyhS{XA])n#Bo8+@fK4kGlc!na&K?_/Oc;D{8 )]lF0YWHxO;P8N}@n%_W');
define('LOGGED_IN_SALT',   'Q5=^I=:tjP_/D<ewQ*pn>FG?/hg]*5B{B5Tj<6bpEPH&Zd|#d(6i<#<IiC9tUSQF');
define('NONCE_SALT',       ',n5_H(x;Kjog-`:EHEu{J4PHHGr];tu8rSn?2*5#Banb<vtGkXE9:x?G-Z/%X7,%');

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
