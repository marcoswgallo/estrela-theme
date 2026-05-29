<?php
/**
 * Template para a página de erro 404 (conteúdo não encontrado).
 */

get_header(); ?>

<main class="page-main" id="page-content">

    <div class="page-hero-simple">
        <div class="container">
            <h1 class="fade-in-up">Página não encontrada</h1>
            <p style="color: rgba(255,255,255,0.8); max-width: 600px; margin: 12px auto 0;">
                O conteúdo que você procura pode ter sido movido ou não existe mais.
            </p>
        </div>
    </div>

    <section class="page-body">
        <div class="container">
            <div class="page-content-inner text-center">
                <p>Verifique o endereço digitado ou utilize a busca abaixo para encontrar o que precisa.</p>

                <div style="max-width: 480px; margin: 2rem auto;">
                    <?php get_search_form(); ?>
                </div>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary mt-2">
                    <i data-feather="home" class="icon-sm"></i> Voltar à Página Inicial
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
