<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */

get_header();
?>

<main id="primary" class="site-main container" style="padding: 120px 0 60px;">
    <?php
    if ( have_posts() ) :
        if ( is_home() && ! is_front_page() ) :
            ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
            <?php
        endif;

        /* Start the Loop */
        while ( have_posts() ) :
            the_post();

            // Simples exibição do conteúdo de fallback
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom: 40px;">
                <header class="entry-header">
                    <?php
                    if ( is_singular() ) :
                        the_title( '<h1 class="entry-title section-title">', '</h1>' );
                    else :
                        the_title( '<h2 class="entry-title section-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    endif;
                    ?>
                </header>

                <div class="entry-content">
                    <?php
                    the_content(
                        sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'estrela-theme' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post( get_the_title() )
                        )
                    );
                    ?>
                </div>
            </article>
            <?php
        endwhile;

        the_posts_navigation();

    else :
        // Se nenhum post for encontrado
        echo '<p>Nenhum conteúdo encontrado.</p>';
    endif;
    ?>
</main><!-- #main -->

<?php
get_footer();
