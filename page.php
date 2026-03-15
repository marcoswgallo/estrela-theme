<?php
/**
 * Template para Páginas Internas (Quem Somos, Publicações, etc.)
 * Utiliza o header e footer do tema Estrela para garantir visual consistente.
 */

get_header(); ?>

<main class="page-main" id="page-content">
    <?php
    while ( have_posts() ) :
        the_post();
    ?>
    <div class="page-hero">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="page-hero-bg" style="background-image: url('<?php the_post_thumbnail_url('full'); ?>');">
                <div class="page-hero-overlay"></div>
            </div>
            <div class="container page-hero-content">
                <h1 class="fade-in-up"><?php the_title(); ?></h1>
            </div>
        <?php else : ?>
            <div class="page-hero-simple">
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="page-body container">
        <div class="page-content-inner">
            <?php the_content(); ?>
        </div>
    </div>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
