<?php
/**
 * Theme Name: TygartMedia WordPress Theme
 * Description: Custom WordPress theme for TygartMedia deployed via GitHub
 * Author: TygartMedia
 * Version: 1.0
 * Text Domain: tygartmedia
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function tygartmedia_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style'
    ));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'tygartmedia'),
        'footer' => __('Footer Menu', 'tygartmedia'),
    ));
}
add_action('after_setup_theme', 'tygartmedia_setup');

// Enqueue styles and scripts
function tygartmedia_scripts() {
    // Main stylesheet
    wp_enqueue_style('tygartmedia-style', get_stylesheet_uri(), array(), '1.0');
    
    // Main JavaScript
    wp_enqueue_script('tygartmedia-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
    
    // Responsive
    wp_enqueue_style('tygartmedia-responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'tygartmedia_scripts');

// Widget areas
function tygartmedia_widgets_init() {
    register_sidebar(array(
        'name'          => __('Main Sidebar', 'tygartmedia'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'tygartmedia'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'tygartmedia'),
        'id'            => 'sidebar-2',
        'description'   => __('Add widgets for the footer.', 'tygartmedia'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'tygartmedia_widgets_init');

// Custom post types for client work
function tygartmedia_custom_post_types() {
    // Projects post type
    register_post_type('projects', array(
        'labels' => array(
            'name' => __('Projects', 'tygartmedia'),
            'singular_name' => __('Project', 'tygartmedia'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-portfolio',
    ));
    
    // Testimonials post type  
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => __('Testimonials', 'tygartmedia'),
            'singular_name' => __('Testimonial', 'tygartmedia'),
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
    ));
}
add_action('init', 'tygartmedia_custom_post_types');

// Custom theme functions
function tygartmedia_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'tygartmedia_excerpt_length');

// Add deployment info to admin bar
function tygartmedia_admin_bar_deployment_info($wp_admin_bar) {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    $args = array(
        'id'    => 'deployment-info',
        'title' => '🚀 GitHub Deployed: ' . date('M j, Y'),
        'href'  => 'https://github.com/willtygart/ai-model-personalities',
        'meta'  => array(
            'target' => '_blank',
            'title'  => 'View on GitHub'
        )
    );
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'tygartmedia_admin_bar_deployment_info', 999);

// Security enhancements
function tygartmedia_security() {
    // Remove WordPress version
    remove_action('wp_head', 'wp_generator');
    
    // Hide admin bar for non-admins
    if (!current_user_can('administrator')) {
        show_admin_bar(false);
    }
}
add_action('init', 'tygartmedia_security');

// GitHub deployment webhook handler
function tygartmedia_github_webhook() {
    if (isset($_GET['github_deploy']) && $_GET['github_deploy'] === 'trigger') {
        // Log deployment
        error_log('TygartMedia: GitHub deployment triggered at ' . date('Y-m-d H:i:s'));
        
        // Clear cache if using caching plugin
        if (function_exists('w3tc_flush_all')) {
            w3tc_flush_all();
        }
        
        wp_die('Deployment webhook received', 'Deployment', array('response' => 200));
    }
}
add_action('init', 'tygartmedia_github_webhook');

?>