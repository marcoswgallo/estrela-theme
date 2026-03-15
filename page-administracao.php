<?php
/**
 * Template Name: Administração
 *
 * Página pública que apresenta a atual administração da
 * Loja Estrela de Ribeirão Preto Nº 3132.
 */

get_header(); ?>

<main class="page-main admin-page" id="page-content">

    <div class="page-hero-simple">
        <div class="container">
            <h1 class="fade-in-up">Administração</h1>
            <p style="color: rgba(255,255,255,0.8); max-width: 600px; margin: 12px auto 0;">
                Conheça os Obreiros que servem com dedicação e fraternidade na atual Administração da Loja.
            </p>
        </div>
    </div>

    <section class="admin-section">
        <div class="container">

            <div class="admin-header text-center">
                <span class="section-subtitle">Gestão Atual</span>
                <h2 class="section-title">A. R. L. S. <span class="highlight-dark">Estrela de Ribeirão Preto</span></h2>
                <p class="admin-subtitle">Loja Nº 3132 — Grande Oriente do Brasil</p>
            </div>

            <!-- Officer Cards Grid -->
            <div class="officers-grid">

                <!-- Venerável Mestre — Destaque -->
                <div class="officer-card officer-vem">
                    <div class="officer-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/veneravel.png" alt="Joia do Venerável Mestre" class="officer-jewel">
                    </div>
                    <h3 class="officer-name">Jeferson Alves Moraes</h3>
                    <p class="officer-role">Venerável Mestre</p>
                </div>

                <div class="officer-card">
                    <div class="officer-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/1-vigilante.png" alt="Joia do 1º Vigilante" class="officer-jewel">
                    </div>
                    <h3 class="officer-name">Nelson Luiz Palomino</h3>
                    <p class="officer-role">1º Vigilante</p>
                </div>

                <div class="officer-card">
                    <div class="officer-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/2-vigilante.png" alt="Joia do 2º Vigilante" class="officer-jewel">
                    </div>
                    <h3 class="officer-name">Christian Harley Douglas Moro</h3>
                    <p class="officer-role">2º Vigilante</p>
                </div>

                <div class="officer-card">
                    <div class="officer-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/orador.png" alt="Joia do Orador" class="officer-jewel">
                    </div>
                    <h3 class="officer-name">Euripedes Sergio Bredariol</h3>
                    <p class="officer-role">Orador</p>
                </div>

                <div class="officer-card">
                    <div class="officer-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/joia-secretario.png" alt="Joia do Secretário" class="officer-jewel">
                    </div>
                    <h3 class="officer-name">Edson Luis Soares</h3>
                    <p class="officer-role">Secretário</p>
                </div>

                <div class="officer-card">
                    <div class="officer-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tesoureiro.png" alt="Joia do Tesoureiro" class="officer-jewel">
                    </div>
                    <h3 class="officer-name">Marcos Rodrigo Sciarreta Segato</h3>
                    <p class="officer-role">Tesoureiro</p>
                </div>

                <div class="officer-card">
                    <div class="officer-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/chanceler.png" alt="Joia do Chanceler" class="officer-jewel">
                    </div>
                    <h3 class="officer-name">Marcos Wesley Gallo</h3>
                    <p class="officer-role">Chanceler</p>
                </div>

            </div><!-- .officers-grid -->

            <!-- Tabela Formal (alternativa visual) -->
            <div class="admin-table-wrapper">
                <h3 class="admin-table-title">Quadro da Administração</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jeferson Alves Moraes</td>
                            <td><span class="role-badge vem">Venerável Mestre</span></td>
                        </tr>
                        <tr>
                            <td>Nelson Luiz Palomino</td>
                            <td><span class="role-badge">1º Vigilante</span></td>
                        </tr>
                        <tr>
                            <td>Christian Harley Douglas Moro</td>
                            <td><span class="role-badge">2º Vigilante</span></td>
                        </tr>
                        <tr>
                            <td>Euripedes Sergio Bredariol</td>
                            <td><span class="role-badge">Orador</span></td>
                        </tr>
                        <tr>
                            <td>Edson Luis Soares</td>
                            <td><span class="role-badge">Secretário</span></td>
                        </tr>
                        <tr>
                            <td>Marcos Rodrigo Sciarreta Segato</td>
                            <td><span class="role-badge">Tesoureiro</span></td>
                        </tr>
                        <tr>
                            <td>Marcos Wesley Gallo</td>
                            <td><span class="role-badge">Chanceler</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>