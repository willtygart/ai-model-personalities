<?php
// Save this file as: wp-config.php

/**
 * WordPress Configuration for Google Cloud Platform
 * TygartMedia WordPress Deployment
 */

// ** MySQL settings - from Google Cloud SQL ** //
define('DB_NAME', getenv('DB_NAME') ?: 'wordpress');
define('DB_USER', getenv('DB_USER') ?: 'wordpress');
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST') ?: ':/cloudsql/gen-lang-client-0530082139:us-central1:wordpress-db');

// ** Database Charset ** //
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// ** Authentication Unique Keys and Salts ** //
// Generate these at https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',         getenv('AUTH_KEY') ?: 'put your unique phrase here');
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY') ?: 'put your unique phrase here');
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY') ?: 'put your unique phrase here');
define('NONCE_KEY',        getenv('NONCE_KEY') ?: 'put your unique phrase here');
define('AUTH_SALT',        getenv('AUTH_SALT') ?: 'put your unique phrase here');
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT') ?: 'put your unique phrase here');
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT') ?: 'put your unique phrase here');
define('NONCE_SALT',       getenv('NONCE_SALT') ?: 'put your unique phrase here');

// ** WordPress Database Table prefix ** //
$table_prefix = 'wp_';

// ** WordPress debugging ** //
$wordpress_env = getenv('WORDPRESS_ENV') ?: 'production';
if ($wordpress_env === 'staging' || $wordpress_env === 'development') {
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', true);
    define('WP_DEBUG_DISPLAY', false);
} else {
    define('WP_DEBUG', false);
}

// ** Security Settings ** //
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', false); // Allow plugin/theme installs
define('WP_AUTO_UPDATE_CORE', true);
define('FORCE_SSL_ADMIN', true);

// ** Performance Settings ** //
define('WP_CACHE', true);
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// ** Cloud Storage Settings (for media files) ** //
if (getenv('GCS_BUCKET')) {
    define('WP_STATELESS_MEDIA_MODE', 'cdn');
    define('WP_STATELESS_MEDIA_BUCKET', getenv('GCS_BUCKET'));
}

// ** Cloudflare Integration ** //
if (isset($_SERVER['HTTP_CF_VISITOR'])) {
    $visitor = json_decode($_SERVER['HTTP_CF_VISITOR']);
    if ($visitor->scheme == 'https') {
        $_SERVER['HTTPS'] = 'on';
        $_SERVER['SERVER_PORT'] = 443;
    }
}

// Set correct HTTPS detection for Cloud Run behind load balancer
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// ** Multisite Configuration (if needed) ** //
// define('WP_ALLOW_MULTISITE', true);
// define('MULTISITE', true);
// define('SUBDOMAIN_INSTALL', false);
// define('DOMAIN_CURRENT_SITE', 'tygartmedia.com');
// define('PATH_CURRENT_SITE', '/');
// define('SITE_ID_CURRENT_SITE', 1);
// define('BLOG_ID_CURRENT_SITE', 1);

// ** Custom WordPress URL ** //
$site_url = 'https://wordpress.tygartmedia.com';
if (getenv('WORDPRESS_ENV') === 'staging') {
    $site_url = 'https://wordpress-staging.tygartmedia.com';
}

define('WP_HOME', $site_url);
define('WP_SITEURL', $site_url);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';