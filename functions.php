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
    // Fonts — Cinzel (títulos lapidares, evoca inscrição em pedra) + EB Garamond
    // (corpo serifado clássico) + Montserrat (rótulos/eyebrows em caixa alta).
    wp_enqueue_style(
        'estrela-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;900&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Montserrat:wght@400;500;600&display=swap',
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

/**
 * ELEMENTOS DECORATIVOS — Estrela flamejante e divisores ornamentais
 *
 * A "Estrela" é o leitmotiv visual da identidade da Loja. Estes helpers
 * centralizam o SVG para reuso consistente em todos os templates.
 */

/**
 * Retorna o SVG da estrela flamejante de cinco pontas.
 *
 * @param string $class Classe(s) CSS extra aplicada(s) ao <svg>.
 * @return string Markup SVG.
 */
function estrela_star_svg( $class = '' ) {
    $class = trim( 'estrela-star ' . $class );
    return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 100 100" aria-hidden="true" focusable="false">'
        . '<polygon points="50,2 61.2,34.6 95.6,35.2 68.1,55.9 78.2,88.8 50,69 21.8,88.8 31.9,55.9 4.4,35.2 38.8,34.6"/>'
        . '</svg>';
}

/**
 * Imprime um divisor ornamental: filete dourado — estrela — filete dourado.
 *
 * @param bool $light Use true em fundos escuros (ajusta a cor via classe).
 */
function estrela_divider( $light = false ) {
    $class = 'ornament-divider' . ( $light ? ' ornament-divider--light' : '' );
    echo '<div class="' . esc_attr( $class ) . '" aria-hidden="true">'
        . '<span class="ornament-line"></span>'
        . estrela_star_svg( 'ornament-star' )
        . '<span class="ornament-line"></span>'
        . '</div>';
}
