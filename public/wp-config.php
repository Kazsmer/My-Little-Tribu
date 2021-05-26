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
define( 'AUTH_KEY',         '$2y$10$L6cU8FjyrEwC/7FepIgBEe9X3Yqpyr/vPY3A00o70dlJ6AnQG3slq' );
define( 'SECURE_AUTH_KEY',  '$2y$10$HSu8SVDgjfPqq3/ff9wQZ.Dln1YB0ZxcW2pmVljoGcvHAAJUNVa2O' );
define( 'LOGGED_IN_KEY',    '$2y$10$eiuVp7.Ytt7GpQ4NFE88lOk5LqSoeaztOdyiqxvw3S8TEElmlksgq' );
define( 'NONCE_KEY',        '$2y$10$vUurTQdJEim8Qtx222RUWOl5k8UiU2luumeFLYMHgEnPKYEZdX1qi' );
define( 'AUTH_SALT',        '$2y$10$DmIL0uhglIxZ5D354MwTXOX0HL5HlgumMYzCWGS2/VflPEy4FyAnK' );
define( 'SECURE_AUTH_SALT', '$2y$10$vY7Ht76SH.1CrIR07vDG8OT/qJQhYK2eBe15NumQlMonKtTz3wHcy' );
define( 'LOGGED_IN_SALT',   '$2y$10$ARew3DJb8aH.bycjImBpXuuPcUtK0Jsyq92leSGvFoEVyRRuTlqkq' );
define( 'NONCE_SALT',       '$2y$10$Za7ToPZnfDyZwzXHMRBdNubEk5K4MyqywOvnzLg3pTgwmtxhKK8AW' );

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



    define('WP_HOME', rtrim ( 'http://ec2-3-95-14-27.compute-1.amazonaws.com/projet-my-little-tribu/public/', '/' ));
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
