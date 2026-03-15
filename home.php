<?php
/**
 * home.php
 * Template para a página de Blog / Listagem de Posts.
 * O WordPress usa este arquivo automaticamente quando uma página é configurada
 * como "Página de Posts" em Configurações > Leitura.
 */

get_header(); ?>

<main class="page-main blog-listing-page" id="page-content">

    <div class="page-hero-simple">
        <div class="container">
            <h1 class="fade-in-up">Obras e Filantropia</h1>
            <p style="color: rgba(255,255,255,0.8); max-width: 600px; margin: 12px auto 0;">
                Notícias, ações e momentos da nossa Loja Maçônica.
            </p>
        </div>
    </div>

    <section class="blog-masonry" style="padding: 70px 0;">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <div class="masonry-grid">
                    <?php 
                    $count = 0;
                    while ( have_posts() ) : the_post();
                        $count++;
                    ?>
                        <article class="masonry-item card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'card-img' ) ); ?>
                                </a>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog_charity_1773579381904.png" alt="Ação Filantrópica" class="card-img">
                            <?php endif; ?>

                            <div class="card-content">
                                <span class="category">
                                    <?php 
                                    $categories = get_the_category();
                                    echo ! empty( $categories ) ? esc_html( $categories[0]->name ) : 'Notícia';
                                    ?>
                                </span>
                                <h3>
                                    <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;"><?php the_title(); ?></a>
                                </h3>
                                <p><?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    Leia mais <i data-feather="arrow-right" class="icon-sm"></i>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Paginação -->
                <div class="blog-pagination text-center mt-4">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '<i data-feather="chevron-left"></i> Anterior',
                        'next_text' => 'Próxima <i data-feather="chevron-right"></i>',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <p class="text-center" style="grid-column: 1 / -1;">Nenhuma publicação encontrada ainda.</p>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
