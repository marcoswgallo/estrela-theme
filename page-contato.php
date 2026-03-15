<?php
/**
 * Template Name: Contato
 * 
 * Template personalizado para a página de contato, contendo grid com informações
 * (E-mail, Endereço) e o formulário de mensagem à direita.
 */

get_header(); ?>

<main class="page-main contact-page" id="page-content">
    
    <div class="page-hero-simple">
        <div class="container">
            <h1 class="fade-in-up">Entre em Contato</h1>
            <p style="color: rgba(255,255,255,0.8); max-width: 600px; margin: 15px auto 0;">
                Dúvidas, sugestões ou interesse em conhecer mais sobre nossa Loja? Preencha o formulário abaixo ou utilize nossos canais diretos de atendimento.
            </p>
        </div>
    </div>

    <div class="page-body container">
        <div class="contact-grid">
            
            <!-- Left Info Panel -->
            <div class="contact-info-panel">
                <h3 class="gold title-sm mb-3" style="color: var(--accent-gold);">Informações</h3>
                
                <div class="info-item">
                    <i data-feather="mail" class="info-icon"></i>
                    <div>
                        <strong>E-mail</strong><br>
                        <a href="mailto:secretaria@estreladeribeiraopreto.com.br" class="text-link" style="color: var(--white);">secretaria@estreladeribeiraopreto.com.br</a>
                    </div>
                </div>

                <div class="info-item">
                    <i data-feather="map-pin" class="info-icon"></i>
                    <div>
                        <strong>Endereço</strong><br>
                        <span style="color: rgba(255,255,255,0.8);">R. Francisca Massaro Farinha, 385/399<br>Ribeirânia, Ribeirão Preto - SP, 14096-460</span>
                    </div>
                </div>

                <div class="info-item">
                    <i data-feather="clock" class="info-icon"></i>
                    <div>
                        <strong>Reuniões</strong><br>
                        <a href="/eventos/" class="text-link" style="color: rgba(255,255,255,0.8); text-decoration: underline;">Veja nosso Calendário / Eventos</a>
                    </div>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="contact-form-panel">
                <h3 class="title-sm mb-3">Envie sua Mensagem</h3>
                
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php 
                        // Permitir integração com plugins de formulário (ex: Contact Form 7, WPForms) através do editor Gutenberg.
                        $content = get_the_content();
                        if ( !empty($content) ) : 
                            the_content(); // Renderiza o shortcode do plugin
                        else :
                    ?>
                    
                        <!-- Fallback HTML Form (demonstrativo/visual) -->
                        <form class="custom-contact-form" action="#" method="post">
                            <div class="form-group row-group">
                                <div class="col-full">
                                    <label for="nome">Nome Completo *</label>
                                    <input type="text" id="nome" name="nome" required placeholder="Seu nome">
                                </div>
                            </div>
                            
                            <div class="form-group row-group">
                                <div class="col-half">
                                    <label for="email">E-mail *</label>
                                    <input type="email" id="email" name="email" required placeholder="seu@email.com">
                                </div>
                                <div class="col-half">
                                    <label for="telefone">Telefone</label>
                                    <input type="tel" id="telefone" name="telefone" placeholder="(16) 99999-9999">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="assunto">Assunto</label>
                                <input type="text" id="assunto" name="assunto" placeholder="Motivo do contato">
                            </div>

                            <div class="form-group">
                                <label for="mensagem">Mensagem *</label>
                                <textarea id="mensagem" name="mensagem" rows="5" required placeholder="Digite sua mensagem detalhada aqui..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Enviar Mensagem</button>
                            <p class="form-note mt-1" style="font-size: 0.8rem; color: #666; margin-top: 15px;">
                                <em>* Este formulário ficará funcional assim que você inserir o shortcode de um plugin como o WPForms na edição desta página.</em>
                            </p>
                        </form>

                    <?php 
                        endif;
                    endwhile; endif; 
                ?>
            </div>
            
        </div>
    </div>
</main>

<?php get_footer(); ?>
