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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '|z&H_4S)K~OThQ8UC!/nH#te73fg}=Z+S-W^emMtij;Td| fJebl?s<og2bdMRRt' );
define( 'SECURE_AUTH_KEY',  '96tUIX09p9nuZXdML!WR:l3FrTs!wpTE= N@ZbR<c^F!&TQ/Q@*[^7,~;XiC!0r`' );
define( 'LOGGED_IN_KEY',    'Z?HruPF@Fy,zREk4[xd1=pz>KtFTUF?O,:~f5cImL!lJNh]-l2R=BaHNo4`YksOw' );
define( 'NONCE_KEY',        '3F_RDmV[%O@-!kH2Mxe;GsKw=g3Gn:*j,6DWt87tsO_/YQ4lO<b~hOK:!UH*7QC]' );
define( 'AUTH_SALT',        'Hy>eJpnGO9KnX0qQFtn:Q%%QL)M(?Z`mVveo2|/XoxE>F<@]t uRz5//!W+GNz8j' );
define( 'SECURE_AUTH_SALT', '*aXh(Jqp92R}n#[@y#|^7gF|TsZj}mhY&YS:nHZ/d3)$Hs][gpy_[WQRh!aG!&]w' );
define( 'LOGGED_IN_SALT',   'oQ~)&EwA|tH*_oW,GStP{megTB!X.>^N[+4LMWhR=+V]XZj,2g,oQfuNtxST6%jq' );
define( 'NONCE_SALT',       '6]VfR6LUf7380-o6>_F|RvGt]p!>7U)^=(tRZp1tQ!CL7nn MM7M@}[4e+TaCK4m' );

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
