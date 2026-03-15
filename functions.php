<?php
/**
 * Theme Functions and Definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Enqueue scripts and styles.
 */
function estrela_theme_scripts() {
    // Fonts
    wp_enqueue_style( 'estrela-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Roboto:wght@300;400;500&display=swap', array(), null );
    
    // Main stylesheet
    wp_enqueue_style( 'estrela-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Feather Icons
    wp_enqueue_script( 'feather-icons', 'https://unpkg.com/feather-icons', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'estrela_theme_scripts' );

/**
 * Setup theme defaults and register support
 */
function estrela_theme_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Register Navigation Menus
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Primary Menu', 'estrela-theme' ),
            'footer' => esc_html__( 'Footer Menu', 'estrela-theme' ),
        )
    );
}
add_action( 'after_setup_theme', 'estrela_theme_setup' );
