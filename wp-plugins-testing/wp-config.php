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
define('DB_NAME', 'wp-test-plugins');

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
define('AUTH_KEY',         '[b^Tx[=pKz8a5K2F=XD0zBz7UVZB`9-`,<;sKW#GC@$6my*27zO>FQrqCsL>Emx+');
define('SECURE_AUTH_KEY',  '<6s:f,&)6^a5dHD(}Q3gcPg{awL,^K:d>zVMa/hv-(4OR54m53Gs$cY1zW9[(BG4');
define('LOGGED_IN_KEY',    '^[cW`F]/tc)G|H9hNlG6u}tK!vCQ#$c=C[<<1 H0H0eiJ/h)`?^>xB4f1@;7lu%a');
define('NONCE_KEY',        '5-g4x/T5A9pGjvlvVV:QVX!,#v]_>X}a:;,4>(S;V#m2<%$w~X7pF=Rw~ :g)HjX');
define('AUTH_SALT',        'y^e09tUo%K8;H6vM.!{40lLg?Y[uEZs/AMy!ik6Gw(IJf?xX=JzI[*j}iBJmEFOo');
define('SECURE_AUTH_SALT', 'tUXSlb/}l,o_rgz@8KP5mRAB|3YZN-(/12vD`* XqPNB>HomF/:]|WUv1RW0Ah^B');
define('LOGGED_IN_SALT',   'Yf`2,8,JQ`?U}*0XO;>*eZCA1rp]CMRbH~/DAZV@!CBNw{NZAg(1V|glQTP2]KfN');
define('NONCE_SALT',       '_h#R!OI p$e1RhR{~uG6T(cRjGZU8n#%|<iX=j,*F(.z=;}*[0?pgx>JRI4cm+,5');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
