<?php
/**
 * Template Name: Página Inicial Estrela
 * Description: O template de página inicial com as seções Hero, Contadores e Blog Masonry.
 */

get_header(); ?>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero_bg_masonic_1773579347267.png');"></div>
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h1 class="fade-in-up">Tradição, Integridade &<br><span class="highlight">Fraternidade.</span></h1>
            <p class="fade-in-up delay-1">Uma fraternidade moderna enraizada em sabedoria ancestral, dedicada ao progresso intelectual, moral e espiritual da humanidade.</p>
            <div class="hero-buttons fade-in-up delay-2">
                <a href="#sobre" class="btn btn-primary">Conhecer a Loja</a>
                <a href="/eventos/" class="btn btn-text">Próximas Sessões <i data-feather="arrow-right"></i></a>
            </div>
        </div>
    </section>




    <!-- About Section -->
    <section class="about" id="sobre">
        <div class="container about-wrapper">
            <div class="about-text">
                <h4 class="section-subtitle">Nossa História</h4>
                <h2 class="section-title">O Templo da Razão e da <span class="highlight-dark">Tradição Secular</span></h2>
                <p>Fundada sob os pilares de Liberdade, Igualdade e Fraternidade, a Loja Estrela de Ribeirão Preto Nº 3132 tem sido um farol de desenvolvimento humano e benevolência na comunidade há décadas.</p>
                <p>Através do estudo e da disciplina ética, nossos obreiros se dedicam ao aperfeiçoamento contínuo — não apenas para o benefício próprio, mas no serviço incessante pela paz universal e pelo bem-estar da sociedade.</p>
                <a href="/sobre/" class="btn btn-primary mt-2">Ler História Completa</a>
            </div>
            <div class="about-image">
                <div class="image-frame">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/history_masonic_1773579366428.png" alt="História Maçônica">
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Masonry (Notícias e Ações) -->
    <section class="blog-masonry" id="blog">
        <div class="container">
            <div class="section-header text-center">
                <h4 class="section-subtitle">Notícias e Ações</h4>
                <h2 class="section-title">Obras e <span class="highlight-dark">Filantropia</span></h2>
            </div>
            
            <div class="masonry-grid">
                <?php
                // Configuração da WP_Query para buscar as últimas postagens e exibir na grade Masonry
                // Exclui categorias internas da Área do Obreiro da listagem pública
                $restricted_slugs = array( 'avisos', 'atas', 'escalas', 'documentos' );
                $excluded_cat_ids = array();
                foreach ( $restricted_slugs as $slug ) {
                    $cat = get_category_by_slug( $slug );
                    if ( $cat ) {
                        $excluded_cat_ids[] = $cat->term_id;
                    }
                }
                $masonry_args = array(
                    'post_type'        => 'post',
                    'posts_per_page'   => 6,
                    'post_status'      => 'publish',
                    'category__not_in' => $excluded_cat_ids,
                );
                $masonry_query = new WP_Query( $masonry_args );

                if ( $masonry_query->have_posts() ) :
                    $count = 0;
                    while ( $masonry_query->have_posts() ) : $masonry_query->the_post();
                        $count++;
                        
                        // Simulando o efeito alternado de card (com imagem vs texto apenas)
                        // Em um projeto real, isso poderia ser feito verificando um formato de post específico ou tag.
                        if ( $count % 2 === 0 ) :
                        ?>
                            <!-- Card texto apenas -->
                            <article class="masonry-item card card-text-only">
                                <div class="card-content">
                                    <span class="category highlight-cat">
                                        <?php 
                                        $categories = get_the_category();
                                        if ( ! empty( $categories ) ) {
                                            echo esc_html( $categories[0]->name );
                                        } else {
                                            echo 'Palavra do Venerável';
                                        }
                                        ?>
                                    </span>
                                    <h3>"<?php the_title(); ?>"</h3>
                                    <p><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="read-more">Ler Mensagem <i data-feather="arrow-right" class="icon-sm"></i></a>
                                </div>
                            </article>
                        <?php else : ?>
                            <!-- Card padrão com imagem -->
                            <article class="masonry-item card">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'large', array( 'class' => 'card-img' ) ); ?>
                                    </a>
                                <?php else : ?>
                                    <!-- Fallback Imagem -->
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog_charity_1773579381904.png" alt="Ação Filantrópica" class="card-img">
                                <?php endif; ?>
                                
                                <div class="card-content">
                                    <span class="category">
                                        <?php 
                                        $categories = get_the_category();
                                        if ( ! empty( $categories ) ) {
                                            echo esc_html( $categories[0]->name );
                                        } else {
                                            echo 'Notícia';
                                        }
                                        ?>
                                    </span>
                                    <h3><a href="<?php the_permalink(); ?>" style="color: inherit;"><?php the_title(); ?></a></h3>
                                    <p><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="read-more">Leia mais <i data-feather="arrow-right" class="icon-sm"></i></a>
                                </div>
                            </article>
                        <?php endif; ?>
                    <?php endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback caso não haja nenhum post no banco de dados ainda.
                    ?>
                    <p class="text-center" style="grid-column: 1 / -1;">Nenhuma notícia encontrada no WordPress ainda.</p>
                <?php endif; ?>
            </div>
            <div class="text-center mt-4">
                <a href="/blog/" class="btn btn-outline-dark">Ver Todas Notícias</a>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
