</div> 
    </section>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const burger = document.querySelector('.navbar-burger');
        const menu = document.getElementById(burger.dataset.target);

        burger.addEventListener('click', () => {
          burger.classList.toggle('is-active');
          menu.classList.toggle('is-active');
        });
      });
    </script>

    <footer class="footer">
      <div class="content has-text-centered">
        <p>
          &copy; 2025 MatriXYZ - Calculadora de Matrizes. Todos os direitos reservados.
        </p>
      </div>
    </footer>

</body>
</html>