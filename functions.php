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
    wp_enqueue_style(
        'estrela-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Cinzel:wght@400;600;700;900&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Roboto:wght@300;400;500&display=swap',
        array(),
        null
    );
    
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

/**
 * ÁREA DO OBREIRO — Proteção de Conteúdo
 * 
 * Redireciona visitantes não logados para a página de login do WordPress
 * quando tentam acessar a Área do Obreiro OU qualquer post das categorias internas.
 */

// Slugs das categorias restritas
define( 'ESTRELA_RESTRICTED_CATS', array( 'avisos', 'atas', 'escalas', 'documentos' ) );

function estrela_protect_member_area() {
    // Protege a página principal da área
    $protected_slugs = array( 'area-do-obreiro', 'painel-do-obreiro' );

    if ( is_page( $protected_slugs ) && ! is_user_logged_in() ) {
        wp_redirect( wp_login_url( get_permalink() ) );
        exit;
    }

    // Protege posts individuais das categorias internas
    if ( is_single() && ! is_user_logged_in() ) {
        $restricted = ESTRELA_RESTRICTED_CATS;
        foreach ( $restricted as $cat_slug ) {
            if ( in_category( $cat_slug ) ) {
                wp_redirect( wp_login_url( get_permalink() ) );
                exit;
            }
        }
    }
}
add_action( 'template_redirect', 'estrela_protect_member_area' );

/**
 * Excluir categorias internas de TODAS as listagens públicas
 * (blog, homepage, busca, RSS). Não afeta usuários logados.
 */
function estrela_exclude_restricted_from_public( $query ) {
    if ( is_admin() || is_user_logged_in() ) {
        return;
    }

    // Aplica apenas nas queries principais de listagem pública
    if ( $query->is_main_query() && ( $query->is_home() || $query->is_archive() || $query->is_search() || $query->is_feed() ) ) {
        $restricted = ESTRELA_RESTRICTED_CATS;
        $cat_ids_to_exclude = array();
        foreach ( $restricted as $slug ) {
            $cat = get_category_by_slug( $slug );
            if ( $cat ) {
                $cat_ids_to_exclude[] = -$cat->term_id; // Negativo = excluir
            }
        }
        if ( ! empty( $cat_ids_to_exclude ) ) {
            $query->set( 'category__not_in', array_map( 'absint', $cat_ids_to_exclude ) );
        }
    }
}
add_action( 'pre_get_posts', 'estrela_exclude_restricted_from_public' );


/**
 * Registrar o papel (role) personalizado "Obreiro"
 * Chamado apenas uma vez na ativação do tema.
 */
function estrela_register_obreiro_role() {
    if ( ! get_role( 'obreiro' ) ) {
        add_role(
            'obreiro',
            'Obreiro',
            array(
                'read'         => true,
                'edit_posts'   => false,
                'delete_posts' => false,
            )
        );
    }
}
add_action( 'after_setup_theme', 'estrela_register_obreiro_role' );

/**
 * Redirecionar Obreiros logados para a Área do Obreiro em vez do dashboard do WP
 */
function estrela_redirect_obreiro_after_login( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && in_array( 'obreiro', $user->roles ) ) {
        return home_url( '/area-do-obreiro/' );
    }
    return $redirect_to;
}
add_filter( 'login_redirect', 'estrela_redirect_obreiro_after_login', 10, 3 );
