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
    // Fonts — apenas as famílias efetivamente usadas no CSS (Montserrat + Roboto)
    wp_enqueue_style(
        'estrela-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Roboto:wght@300;400;500&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style( 'estrela-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Feather Icons — versão fixa para evitar quebras quando o CDN atualizar
    wp_enqueue_script( 'feather-icons', 'https://unpkg.com/feather-icons@4.29.2/dist/feather.min.js', array(), '4.29.2', true );
}
add_action( 'wp_enqueue_scripts', 'estrela_theme_scripts' );

/**
 * Resource hints — preconnect aos servidores do Google Fonts para acelerar o carregamento.
 */
function estrela_resource_hints( $hints, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $hints[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $hints;
}
add_filter( 'wp_resource_hints', 'estrela_resource_hints', 10, 2 );

/**
 * Setup theme defaults and register support
 */
function estrela_theme_setup() {
    // Carrega as traduções do tema (arquivos .mo na pasta /languages).
    load_theme_textdomain( 'estrela-theme', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Logo personalizável via Personalizador (Aparência > Personalizar).
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Marcação HTML5 para os recursos nativos do WordPress.
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ) );

    // Embeds responsivos no editor de blocos.
    add_theme_support( 'responsive-embeds' );

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
 * Executado apenas na ativação do tema, não em todas as requisições.
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
add_action( 'after_switch_theme', 'estrela_register_obreiro_role' );

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
