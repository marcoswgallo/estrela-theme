<?php
/**
 * Template Name: Área do Obreiro
 *
 * Painel exclusivo para membros logados da Loja Estrela de Ribeirão Preto.
 * Acesso restrito: protegido pela função estrela_protect_member_area() em functions.php.
 */

get_header(); ?>

<main class="page-main obreiro-page" id="page-content">

    <div class="page-hero-simple obreiro-hero">
        <div class="container">
            <h1 class="fade-in-up">
                <i data-feather="shield" style="display:inline-block; vertical-align:middle; margin-right:10px; color: var(--accent-gold);"></i>
                Área do Obreiro
            </h1>
            <?php if ( is_user_logged_in() ) : 
                $current_user = wp_get_current_user();
            ?>
            <p style="color: rgba(255,255,255,0.8); margin-top: 10px;">
                Bem-vindo, <strong style="color: var(--accent-gold);"><?php echo esc_html( $current_user->display_name ); ?></strong>. 
                S.:. F.:. U.:.
            </p>
            <?php endif; ?>
        </div>
    </div>

    <?php if ( ! is_user_logged_in() ) : ?>
        <!-- Fallback se a proteção em functions.php falhar -->
        <div class="container" style="text-align:center; padding: 80px 20px;">
            <h2>Acesso Restrito</h2>
            <p>Esta área é exclusiva para membros da Loja. Por favor, faça o login.</p>
            <a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="btn btn-primary mt-2">
                Entrar no Portal
            </a>
        </div>

    <?php else : ?>

    <div class="container obreiro-dashboard">

        <!-- Módulos do Painel -->
        <div class="obreiro-grid">

            <!-- Módulo: Quadro de Avisos -->
            <div class="obreiro-module">
                <div class="module-header">
                    <i data-feather="bell" class="module-icon"></i>
                    <h3>Quadro de Avisos</h3>
                </div>
                <div class="module-body">
                    <?php
                    $avisos = get_posts( array(
                        'post_type'      => 'post',
                        'category_name'  => 'avisos',
                        'posts_per_page' => 5,
                        'post_status'    => 'publish',
                    ) );
                    if ( $avisos ) :
                        foreach ( $avisos as $aviso ) :
                    ?>
                        <div class="module-item">
                            <span class="item-date"><?php echo get_the_date( 'd/m/Y', $aviso ); ?></span>
                            <a href="<?php echo get_permalink( $aviso ); ?>" class="item-link"><?php echo esc_html( $aviso->post_title ); ?></a>
                        </div>
                    <?php
                        endforeach;
                    else :
                    ?>
                        <p class="module-empty">Nenhum aviso no momento.</p>
                    <?php endif; wp_reset_postdata(); ?>
                </div>
                <div class="module-footer">
                    <a href="<?php echo esc_url( get_category_link( get_category_by_slug('avisos') ) ); ?>">Ver todos os avisos →</a>
                </div>
            </div>

            <!-- Módulo: Atas das Sessões -->
            <div class="obreiro-module">
                <div class="module-header">
                    <i data-feather="file-text" class="module-icon"></i>
                    <h3>Atas das Sessões</h3>
                </div>
                <div class="module-body">
                    <?php
                    $atas = get_posts( array(
                        'post_type'      => 'post',
                        'category_name'  => 'atas',
                        'posts_per_page' => 5,
                        'post_status'    => 'publish',
                    ) );
                    if ( $atas ) :
                        foreach ( $atas as $ata ) :
                    ?>
                        <div class="module-item">
                            <span class="item-date"><?php echo get_the_date( 'd/m/Y', $ata ); ?></span>
                            <a href="<?php echo get_permalink( $ata ); ?>" class="item-link"><?php echo esc_html( $ata->post_title ); ?></a>
                        </div>
                    <?php
                        endforeach;
                    else :
                    ?>
                        <p class="module-empty">Nenhuma ata publicada ainda.</p>
                    <?php endif; wp_reset_postdata(); ?>
                </div>
            </div>

            <!-- Módulo: Escalas e Cargos -->
            <div class="obreiro-module">
                <div class="module-header">
                    <i data-feather="users" class="module-icon"></i>
                    <h3>Escalas e Cargos</h3>
                </div>
                <div class="module-body">
                    <?php
                    $escalas = get_posts( array(
                        'post_type'      => 'post',
                        'category_name'  => 'escalas',
                        'posts_per_page' => 5,
                        'post_status'    => 'publish',
                    ) );
                    if ( $escalas ) :
                        foreach ( $escalas as $escala ) :
                    ?>
                        <div class="module-item">
                            <span class="item-date"><?php echo get_the_date( 'd/m/Y', $escala ); ?></span>
                            <a href="<?php echo get_permalink( $escala ); ?>" class="item-link"><?php echo esc_html( $escala->post_title ); ?></a>
                        </div>
                    <?php
                        endforeach;
                    else :
                    ?>
                        <p class="module-empty">Nenhuma escala publicada ainda.</p>
                    <?php endif; wp_reset_postdata(); ?>
                </div>
            </div>

            <!-- Módulo: Documentos Fraternas -->
            <div class="obreiro-module">
                <div class="module-header">
                    <i data-feather="folder" class="module-icon"></i>
                    <h3>Documentos Fraternas</h3>
                </div>
                <div class="module-body">
                    <?php
                    $docs = get_posts( array(
                        'post_type'      => 'post',
                        'category_name'  => 'documentos',
                        'posts_per_page' => 5,
                        'post_status'    => 'publish',
                    ) );
                    if ( $docs ) :
                        foreach ( $docs as $doc ) :
                    ?>
                        <div class="module-item">
                            <span class="item-date"><?php echo get_the_date( 'd/m/Y', $doc ); ?></span>
                            <a href="<?php echo get_permalink( $doc ); ?>" target="_blank" class="item-link"><?php echo esc_html( $doc->post_title ); ?></a>
                        </div>
                    <?php
                        endforeach;
                    else :
                    ?>
                        <p class="module-empty">Nenhum documento disponível ainda.</p>
                    <?php endif; wp_reset_postdata(); ?>
                </div>
            </div>

        </div><!-- .obreiro-grid -->

        <!-- Rodapé do Painel -->
        <div class="obreiro-actions">
            <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="btn btn-outline-dark" style="border-color: rgba(255,255,255,0.2); color: #aaa;">
                <i data-feather="log-out" style="vertical-align:middle; margin-right:6px;"></i>
                Sair do Portal
            </a>
        </div>

    </div><!-- .obreiro-dashboard -->

    <?php endif; ?>

</main>

<?php get_footer(); ?>
