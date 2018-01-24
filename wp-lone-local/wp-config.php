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
define('DB_NAME', 'wp-seeds-local');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'oA?SH!d!Fqqey-~[PCs2zqqL[Tz3PH%}4DB,J.!7*be1-E!q7BG31]VCg&ZFUlMs');
define('SECURE_AUTH_KEY',  'zdVBu3@+JL@jRN ,46|6.{lV Q4RuJ${CZn9.JH#Bl}6(6,=^|6q0NTNbvN6|k2G');
define('LOGGED_IN_KEY',    '|Bn*h<=dwqK%xlBK/6{tk2tIK73Lc/@Xl|v=YRg#Xa)|b*VF~ggs& G,.Q`Jh7ls');
define('NONCE_KEY',        ' Z{WjpcykEp4HwanCAyxi;3X$!@><_-(IWd`(h|A5xBI@B!emqR!QWg 0#o|iECA');
define('AUTH_SALT',        '_]Tdc:QqO,>GVeZO?Co?@TM]Lw~wj0LR:vrc/noy _^itb/1Xv6a-:PJ7/oH2NUR');
define('SECURE_AUTH_SALT', 'qGQmi<VU?OddNJF.6||iNFm)s@vuH#|I,tG`Yl/nz$58{7^*9mOtrK&gdjH(`XGj');
define('LOGGED_IN_SALT',   'Rz!a%nb~7H#af2cZcE{LO1UFWwYs$Kv5l(cm6)%QVvVHQTd<?c_oRtfwUO*L.V{^');
define('NONCE_SALT',       '7}h36r97l#.-Q=[eNYxc% h8qC L1{pBA/RFV ]~S:7L)JD0$uC3*2iQ.%^F:RoV');

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
