<footer class="footer">
  <div class="content has-text-centered">
    <p>&copy; 2025 MatriXYZ. Todos os direitos reservados.</p>
  </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Lógica para adicionar/remover classe 'selected' aos tiles do menu
    document.querySelectorAll('.switch-tile').forEach(tile => {
        tile.addEventListener('click', () => {
            document.querySelectorAll('.switch-tile').forEach(t => t.classList.remove('selected'));
            tile.classList.add('selected');
        });
    });

    // navbar burger
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
    if ($navbarBurgers.length > 0) {
        $navbarBurgers.forEach( el => {
            el.addEventListener('click', () => {
                const target = el.dataset.target;
                const $target = document.getElementById(target);
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');
            });
        });
    }

    // CÓDIGO PARA ROLAGEM DO MENU
    const scrollMenu = document.querySelector('.switch-menu-container');
    const scrollLeftBtn = document.querySelector('.switch-nav-button.is-left');
    const scrollRightBtn = document.querySelector('.switch-nav-button.is-right');

    if (scrollMenu && scrollLeftBtn && scrollRightBtn) {
        const scrollAmount = 300; // Quantidade de pixels para rolar por clique

        scrollLeftBtn.addEventListener('click', () => {
            scrollMenu.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        scrollRightBtn.addEventListener('click', () => {
            scrollMenu.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        const updateButtonVisibility = () => {
            const currentScroll = scrollMenu.scrollLeft;
            const maxScroll = scrollMenu.scrollWidth - scrollMenu.clientWidth;
            const threshold = 5;

            if (currentScroll <= threshold) {
                scrollLeftBtn.style.opacity = '0.3';
                scrollLeftBtn.style.cursor = 'default';
                scrollLeftBtn.disabled = true;
            } else {
                scrollLeftBtn.style.opacity = '0.8';
                scrollLeftBtn.style.cursor = 'pointer';
                scrollLeftBtn.disabled = false;
            }

            if (currentScroll >= maxScroll - threshold) {
                scrollRightBtn.style.opacity = '0.3';
                scrollRightBtn.style.cursor = 'default';
                scrollRightBtn.disabled = true;
            } else {
                scrollRightBtn.style.opacity = '0.8';
                scrollRightBtn.style.cursor = 'pointer';
                scrollRightBtn.disabled = false;
            }
        };

        updateButtonVisibility();
        scrollMenu.addEventListener('scroll', updateButtonVisibility);
        window.addEventListener('resize', updateButtonVisibility);
    }
});
</script>
</body>
</html>