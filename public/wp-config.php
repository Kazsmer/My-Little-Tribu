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
define( 'DB_NAME', 'my_little_tribu' );

/** MySQL database username */
define( 'DB_USER', 'explorateur' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Ereul9Aeng' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         '$2y$10$DYj1uqxYR1XxobWFNv/Nwu.5qnhnrimzB5jFf2HBUGxEmE8YNzwpW' );
define( 'SECURE_AUTH_KEY',  '$2y$10$LNt8TRYJww/CVsELyMYe7uHVJQvRrlWnEIMiPLVPJZ3U1KjnoXJzy' );
define( 'LOGGED_IN_KEY',    '$2y$10$rhkTnBs9e2IaCpV.pWEiI.1hYkO0gfnKYC49LJXdaV.yOCrjr.A7q' );
define( 'NONCE_KEY',        '$2y$10$Zbzi7O8kQc.eNSLGq/H2MuYAXq2uKSjGUKdoXnkiJEe1DDP7Vy2tO' );
define( 'AUTH_SALT',        '$2y$10$GXe3ez6UM8KPKzxZi6kYtu4Hb6FojxmVf9ozuFRHyTIU.V79oXQJa' );
define( 'SECURE_AUTH_SALT', '$2y$10$82t2kHGnrXO1rml63VILq.46TkRvXeM8sAXkwHE1I1Hfeloo/bhZu' );
define( 'LOGGED_IN_SALT',   '$2y$10$yqebCIZ44/tbOaM9NzlskeBiDS4vMW86ev5rFP2DsYL6wgevvXFQW' );
define( 'NONCE_SALT',       '$2y$10$GA38X/MDkDJJb1m9cjk2DOnNoTKh38Hs5.eTVvEF.KFxn7v2OHgJq' );

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
define( 'WP_DEBUG', true );

    define('WP_HOME', rtrim ( 'http://localhost/projet-my-little-tribu/public', '/' ));
    define('WP_SITEURL', WP_HOME . '/wp');
    define('WP_CONTENT_URL', WP_HOME . '/wp-content');
    define('WP_CONTENT_DIR', __DIR__ . '/wp-content');
    define('FS_METHOD','direct');
    /* That\'s all, stop editing! Happy publishing. */
    

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
