<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Header Navigation -->
    <header class="main-header" id="header">
        <div class="container nav-wrapper">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                <span class="logo-symbol">G</span>
                <span class="logo-text"><?php bloginfo( 'name' ); ?></span>
            </a>
            <nav class="desktop-nav">
                <?php
                if ( has_nav_menu( 'menu-1' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                            'container'      => false,
                            'fallback_cb'    => false,
                        )
                    );
                } else {
                    echo '<ul><li><a href="#home">Início</a></li><li><a href="#sobre">A Loja</a></li><li><a href="#blog">Notícias</a></li><li><a href="#eventos">Calendário</a></li></ul>';
                }
                ?>
            </nav>
            <div class="header-actions">
                <a href="#portal" class="btn btn-outline">Área do Obreiro</a>
            </div>
            <button class="mobile-menu-btn" aria-label="Abrir menu">
                <i data-feather="menu"></i>
            </button>
        </div>
    </header>
