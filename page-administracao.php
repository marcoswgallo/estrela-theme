<?php
/**
 * Template Name: Administração
 *
 * Página pública que apresenta a atual administração da
 * Loja Estrela de Ribeirão Preto Nº 3132.
 */

get_header();

/**
 * Fonte única de dados da Administração.
 * Para atualizar a diretoria, basta editar este array — os cards e a tabela
 * abaixo são gerados a partir dele, evitando duplicação.
 *
 * 'jewel' = nome do arquivo da joia em /assets/images/
 * 'vem'   = true apenas para o Venerável Mestre (destaque visual)
 */
$estrela_officers = array(
    array( 'name' => 'Jeferson Alves Moraes',            'role' => 'Venerável Mestre', 'jewel' => 'veneravel.png',       'vem' => true ),
    array( 'name' => 'Nelson Luiz Palomino',             'role' => '1º Vigilante',     'jewel' => '1-vigilante.png',     'vem' => false ),
    array( 'name' => 'Christian Harley Douglas Moro',    'role' => '2º Vigilante',     'jewel' => '2-vigilante.png',     'vem' => false ),
    array( 'name' => 'Euripedes Sergio Bredariol',       'role' => 'Orador',           'jewel' => 'orador.png',          'vem' => false ),
    array( 'name' => 'Edson Luis Soares',                'role' => 'Secretário',       'jewel' => 'joia-secretario.png', 'vem' => false ),
    array( 'name' => 'Marcos Rodrigo Sciarreta Segato',  'role' => 'Tesoureiro',       'jewel' => 'tesoureiro.png',      'vem' => false ),
    array( 'name' => 'Marcos Wesley Gallo',              'role' => 'Chanceler',        'jewel' => 'chanceler.png',       'vem' => false ),
);
$estrela_img_base = get_template_directory_uri() . '/assets/images/';
?>

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

            <div class="admin-header text-center reveal">
                <span class="section-subtitle">Gestão Atual</span>
                <h2 class="section-title">A∴ R∴ L∴ S∴ <span class="highlight-dark">Estrela de Ribeirão Preto</span></h2>
                <p class="admin-subtitle">Loja Nº 3132 — Grande Oriente do Brasil</p>
                <?php estrela_divider(); ?>
            </div>

            <!-- Officer Cards Grid -->
            <div class="officers-grid">
                <?php foreach ( $estrela_officers as $index => $officer ) : ?>
                    <div class="officer-card reveal<?php echo $index % 3 === 1 ? ' delay-1' : ( $index % 3 === 2 ? ' delay-2' : '' ); ?><?php echo $officer['vem'] ? ' officer-vem' : ''; ?>">
                        <div class="officer-icon">
                            <img src="<?php echo esc_url( $estrela_img_base . $officer['jewel'] ); ?>"
                                 alt="<?php echo esc_attr( 'Joia do ' . $officer['role'] ); ?>"
                                 class="officer-jewel">
                        </div>
                        <h3 class="officer-name"><?php echo esc_html( $officer['name'] ); ?></h3>
                        <p class="officer-role"><?php echo esc_html( $officer['role'] ); ?></p>
                    </div>
                <?php endforeach; ?>
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
                        <?php foreach ( $estrela_officers as $officer ) : ?>
                            <tr>
                                <td><?php echo esc_html( $officer['name'] ); ?></td>
                                <td><span class="role-badge<?php echo $officer['vem'] ? ' vem' : ''; ?>"><?php echo esc_html( $officer['role'] ); ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>