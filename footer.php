    <!-- Footer / Portal de Membros Teaser -->
    <footer class="footer">
        <div class="container footer-grid">
            <!-- Logo and Description -->
            <div class="footer-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" 
                         alt="<?php bloginfo('name'); ?>" 
                         class="logo-img-footer">
                </a>
                <h3 class="footer-logo-text"><?php bloginfo( 'name' ); ?></h3>
                <p class="footer-logo-description">
                    A serviço da humanidade. Promovendo liberdade, igualdade e fraternidade desde a nossa fundação.
                </p>
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

        // Mobile menu toggle
        const mobileToggle = document.getElementById('mobile-toggle');
        const mobileNav = document.getElementById('mobile-nav');
        if (mobileToggle && mobileNav) {
            mobileToggle.addEventListener('click', () => {
                const isOpen = mobileNav.classList.toggle('open');
                mobileToggle.setAttribute('aria-expanded', isOpen);
                mobileNav.setAttribute('aria-hidden', !isOpen);
            });
        }

        // Sticky header shrink on scroll
        const mainHeader = document.getElementById('header');
        if (mainHeader) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 60) {
                    mainHeader.classList.add('scrolled');
                } else {
                    mainHeader.classList.remove('scrolled');
                }
            }, { passive: true });
        }

        // Simple Counter Animation
        const counters = document.querySelectorAll('.counter');
        if ('IntersectionObserver' in window && counters.length > 0) {
            const speed = 200;
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
                    if(entries[0].isIntersecting) { updateCount(); observer.disconnect(); }
                }, { threshold: 0.5 });
                observer.observe(counter);
            });
        }
    </script>

    
<?php wp_footer(); ?>
</body>
</html>
