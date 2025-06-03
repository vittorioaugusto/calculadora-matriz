<?php include_once 'header_index.php'; ?>

<link rel="stylesheet" href="css/index-style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jersey+20&display=swap" rel="stylesheet">

<script src="js/index-scroll.js" defer></script>

<section class="section">
    <div class="container has-text-centered">
        <h1 class="title main-title-index">Que a curiosidade guie os seus passos!</h1>
        <p class="subtitle mb-6">
            O mapa para os tesouros das matrizes está em suas mãos! No MatriXYZ,
            desmistificamos a álgebra linear e tornamos o aprendizado uma aventura emocionante e mágica. Comece a
            explorar!
        </p>

        <div class="switch-navigation-wrapper" style="position: relative;">
            <button class="switch-nav-button is-left" aria-label="Anterior">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="switch-menu-container">
                <div class="switch-menu">

                    <a class="switch-tile" href="/calculadora-matriz-main/operacoes-matrizes/operacoes_matrizes.php">
                        <div class="tile-image-wrapper">
                            <img src="img/laranja.png" alt="Operações Básicas">
                        </div>
                        <p class="tile-text has-text-weight-bold">OPERAÇÕES BÁSICAS</p>
                    </a>

                    <a class="switch-tile" href="/calculadora-matriz-main/operacoes-matrizes/matriz_escalar.php">
                        <div class="tile-image-wrapper">
                            <img src="img/amarelo.png" alt="Escalar">
                        </div>
                        <p class="tile-text has-text-weight-bold">MULTIPLICAÇÃO POR ESCALAR</p>
                    </a>

                    <a class="switch-tile" href="/calculadora-matriz-main/sistemas-lineares/metodo_gauss.php">
                        <div class="tile-image-wrapper">
                            <img src="img/limao.png" alt="Gauss">
                        </div>
                        <p class="tile-text has-text-weight-bold">MÉTODO DE GAUSS</p>
                    </a>

                    <a class="switch-tile" href="/calculadora-matriz-main/sistemas-lineares/metodo_cramer.php">
                        <div class="tile-image-wrapper">
                            <img src="img/verde-claro.png" alt="Cramer">
                        </div>
                        <p class="tile-text has-text-weight-bold">MÉTODO DE CRAMER</p>
                    </a>

                    <a class="switch-tile"
                        href="/calculadora-matriz-main/cofatores-determinante-inversa/cofatores_determinante_inversa.php">
                        <div class="tile-image-wrapper">
                            <img src="img/menta.png" alt="Determinante">
                        </div>
                        <p class="tile-text has-text-weight-bold">COFATOR, DETERMINANTE E INVERSA</p>
                    </a>

                    <a class="switch-tile" href="/calculadora-matriz-main/matrixyz.php">
                        <div class="tile-image-wrapper">
                            <img src="img/violeta.png" alt="MatriXYZ">
                        </div>
                        <p class="tile-text has-text-weight-bold">SOBRE O MATRIXYZ</p>
                    </a>

                    <a class="switch-tile is-disabled" href="#">
                        <div class="tile-image-wrapper">
                            <img src="img/rosa.png" alt="Em breve">
                        </div>
                        <p class="tile-text has-text-weight-bold">UMA NOVA FUNÇÃO EM BREVE!</p>
                    </a>

                </div>
            </div>

            <button class="switch-nav-button is-right" aria-label="Próximo">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<?php include_once 'footer.php'; ?>