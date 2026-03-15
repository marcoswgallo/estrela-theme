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

    <!-- =====================================================
         HEADER — Two-row layout with large prominent logo
         ===================================================== -->
    <header class="main-header" id="header">


        <!-- Main Nav Bar -->
        <div class="header-navbar">
            <div class="container nav-wrapper">

                <!-- Logo (large, overlapping) -->
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo logo-large" aria-label="Ir para a página inicial">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"
                         alt="<?php bloginfo('name'); ?>"
                         class="logo-img-large">
                    <div class="logo-text-block">
                        <span class="logo-title"><?php bloginfo( 'name' ); ?></span>
                        <span class="logo-subtitle">Fundada em 01 de Setembro de 2025</span>
                    </div>
                </a>

                <!-- Navigation -->
                <nav class="desktop-nav" role="navigation" aria-label="Menu Principal">
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
                        echo '<ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/sobre">Nossa História</a></li>
                            <li><a href="/eventos/">Calendário</a></li>
                            <li><a href="/contato">Contato</a></li>
                        </ul>';
                    }
                    ?>
                </nav>

                <!-- CTA Obreiro -->
                <div class="header-actions">
                    <a href="/area-do-obreiro/" class="btn btn-gold">Área do Obreiro</a>
                </div>

                <!-- Mobile Toggle -->
                <button class="mobile-menu-btn" id="mobile-toggle" aria-label="Abrir menu" aria-expanded="false">
                    <i data-feather="menu"></i>
                </button>
            </div>

            <!-- Mobile Nav (hidden by default) -->
            <div class="mobile-nav" id="mobile-nav" aria-hidden="true">
                <?php
                if ( has_nav_menu( 'menu-1' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'container'      => false,
                            'fallback_cb'    => false,
                        )
                    );
                } else {
                    echo '<ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/sobre">Nossa História</a></li>
                        <li><a href="/eventos/">Calendário</a></li>
                        <li><a href="#portal">Área do Obreiro</a></li>
                    </ul>';
                }
                ?>
            </div>
        </div>
    </header>

    <!-- Spacer so content doesn't hide behind fixed header -->
    <div class="header-spacer"></div>
