<?php
/**
 * Template para exibição de um post individual.
 *
 * Usado tanto para notícias públicas quanto para os posts internos da
 * Área do Obreiro (avisos, atas, escalas, documentos). O acesso restrito
 * é garantido por estrela_protect_member_area() em functions.php.
 */

get_header(); ?>

<main class="page-main" id="page-content">
    <?php
    while ( have_posts() ) :
        the_post();
    ?>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="page-hero">
            <div class="page-hero-bg" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>');">
                <div class="page-hero-overlay"></div>
            </div>
            <div class="container page-hero-content">
                <h1 class="fade-in-up"><?php the_title(); ?></h1>
            </div>
        </div>
    <?php else : ?>
        <div class="page-hero-simple">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    <?php endif; ?>

    <article <?php post_class( 'page-body container' ); ?>>
        <div class="page-content-inner">

            <p class="text-muted text-small" style="margin-bottom: 2rem;">
                <?php
                $estrela_cats = get_the_category();
                if ( ! empty( $estrela_cats ) ) {
                    echo '<span class="category">' . esc_html( $estrela_cats[0]->name ) . '</span> &middot; ';
                }
                echo esc_html( get_the_date() );
                ?>
            </p>

            <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'estrela-theme' ),
                'after'  => '</div>',
            ) );
            ?>

            <div class="mt-4">
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn btn-outline-dark">
                    <i data-feather="arrow-left" class="icon-sm"></i> Voltar
                </a>
            </div>
        </div>
    </article>

    <?php
        // Comentários (caso estejam habilitados para o post)
        if ( comments_open() || get_comments_number() ) {
            echo '<div class="page-body container"><div class="page-content-inner">';
            comments_template();
            echo '</div></div>';
        }
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
