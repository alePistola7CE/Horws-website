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
define('DB_NAME', 'wp_horws');

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
define('AUTH_KEY',         'BfA6=$KTmc*cBc?+`ELP.2{Jip234%=n&KahD9{HU?T~),~pR2{s2Efa$ES.!%MJ');
define('SECURE_AUTH_KEY',  ':Y?$j{rV>!kmqHOszGy2le+{I9T:hF;G[by.2Q6N=B6GJm<]]W(BBP?@hD.~=#o1');
define('LOGGED_IN_KEY',    '3|($N{0q_t!<`E4ol2ciYLE0bDaK~_F#-FSRyk^=&e0tLoriS]mkuoBFKN/p,xBl');
define('NONCE_KEY',        'm-o%Aw#m-rHU_[htI%pNU? h!45/]Q_*0UuE9A$rB|1a>0F2;LSg`s)m&L3kEm#Z');
define('AUTH_SALT',        'mgI/=b8&1Mn6<; +m tjCmj0/j6H^_Tj;s_woNl.W DQ@RK?glk;twXA6xML0s#N');
define('SECURE_AUTH_SALT', '-_iA@3?H%Aaw_e~bK mC>iqA/*Vf<dqND#ly?i2$GwM2Z/Tp&.pkR^;H=KaZ@S@[');
define('LOGGED_IN_SALT',   'V{,U+#||w-pD9U5~{={hAB_$dW%~=Y^w6^##-fuYfP3CU7F4SF{`+E#j>M&$G_l2');
define('NONCE_SALT',       '~s@Cl{g_5@[w&2|lKQ9mwA2DqP8?J./r[:S^hIc:#9L%T9x|VvP!9*VYOXN]tUD>');

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
