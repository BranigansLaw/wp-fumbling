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
define('DB_NAME', 'renovation-find');

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
define('AUTH_KEY',         '<[kj!l}StyV5JEBni;.Ef6oJ#m9;ink:`B=UK%xbjy8g66Zvej6!=[!!*Le_nq<j');
define('SECURE_AUTH_KEY',  'u((}9F8p(/!?%J9~gm}X%y-39:@{OYORQ5[{?~RgtnhSwpN^NRYc$Fg#m$ ,SN9C');
define('LOGGED_IN_KEY',    'R2i?p`kPMiYP.`UBV(yUXcWknQ}>s`p#}lPNOMfhUs&#K8S6M2N5 7aPPVu]*8/E');
define('NONCE_KEY',        '3_Q+mD!0{;wjF} WT8qOfr)@w>9/s;%:TIm5z6zWl4t?NkL$D^UH,cL1,79@{Awx');
define('AUTH_SALT',        '=+&p0a/;l3SCJ2Q(.b6J LPoTdcKI[oGL=,y.X@^z74v3HRT>*6JAZnu!va3W}y_');
define('SECURE_AUTH_SALT', 'TFI+emk.&{4RU#bucqOlzr4Rnd=mRcG;lQSe9H}T7$V6 WfhgM(jo_@ Qeab1s:K');
define('LOGGED_IN_SALT',   '~P5dLe, -[R<GV(]9w[hpz,*Job|8*w9./7laIoavjr5Wt?Qy`M7g[M{9P4{23ky');
define('NONCE_SALT',       'vZ<1/wK?PNk|0@Q8omyF,/oxensBKksjRL5$NY&Kh?+WBfTnyfyzwE,(LP]<UM8W');

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
