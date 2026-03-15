    <!-- Footer / Portal de Membros Teaser -->
    <footer class="footer">
        <div class="container footer-grid">
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo text-white">
                    <span class="logo-symbol gold">G</span>
                    <span class="logo-text"><?php bloginfo('name'); ?></span>
                </a>
                <p class="mt-2 text-muted"><?php bloginfo('description'); ?> A serviço da humanidade. Promovendo liberdade, igualdade e fraternidade desde a nossa fundação.</p>
            </div>
            
            <div class="footer-links">
                <h4 class="footer-title">Acesso Rápido</h4>
                <?php
                if ( has_nav_menu( 'footer' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'container'      => false,
                            'fallback_cb'    => false,
                        )
                    );
                } else {
                    echo '<ul><li><a href="#home">Página Inicial</a></li><li><a href="#sobre">História da Loja</a></li><li><a href="#blog">Ações Filantrópicas</a></li><li><a href="#eventos">Calendário Fraternal</a></li></ul>';
                }
                ?>
            </div>

            <div class="footer-portal" id="portal">
                <h4 class="footer-title gold">Área do Obreiro</h4>
                <p class="text-muted text-small mb-2">Acesso restrito a membros regulares da loja.</p>
                <form class="portal-login-form" action="<?php echo esc_url( wp_login_url() ); ?>" method="post">
                    <input type="text" name="log" placeholder="Usuário" class="member-input" required>
                    <input type="password" name="pwd" placeholder="Senha" class="member-input" required>
                    <button type="submit" name="wp-submit" class="btn btn-primary btn-block mt-1">Entrar no Portal</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Init Icons and Scripts -->
    <script>
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        
        // Header Scroll Effect
        const header = document.getElementById('header');
        if(header) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        }

        // Simple Counter Animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        if ('IntersectionObserver' in window && counters.length > 0) {
            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;
                    const inc = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc);
                        setTimeout(updateCount, 15);
                    } else {
                        counter.innerText = target;
                    }
                };
                
                const observer = new IntersectionObserver((entries) => {
                    if(entries[0].isIntersecting) {
                        updateCount();
                        observer.disconnect();
                    }
                }, { threshold: 0.5 });
                
                observer.observe(counter);
            });
        }
    </script>
    
<?php wp_footer(); ?>
</body>
</html>
