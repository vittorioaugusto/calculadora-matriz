<?php 
include_once 'header_index.php'; 
?>

<h1 class="has-text-centered is-size-3">
    <span class="gradient-text">Que a curiosidade guie os seus passos!</span>
</h1>
<p class="subtitle has-text-centered mb-6">O mapa para os tesouros das matrizes está em suas mãos! No MatriXYZ,
    desmistificamos a álgebra linear e tornamos o aprendizado uma aventura emocionante e mágica. Comece a explorar!</p>

<div class="switch-navigation-wrapper">
    <button class="switch-nav-button is-left" aria-label="Anterior">
        <i class="fas fa-chevron-left"></i>
    </button>

    <div class="switch-menu-container">

        <div class="switch-menu">

            <a class="switch-tile box" href="/calculadora-matriz-main/operacoes-matrizes/operacoes_matrizes.php">
                <figure class="image is-128x128 mb-3"> <img src="img/1739515.png" alt="Operações Básicas">
                </figure>
                <p class="has-text-weight-bold">Operações</p>
            </a>

            <a class="switch-tile box" href="/calculadora-matriz-main/operacoes-matrizes/matriz_escalar.php">
                <figure class="image is-128x128 mb-3">
                    <img src="img/1739515.png" alt="Escalar">
                </figure>
                <p class="has-text-weight-bold">Escalar</p>
            </a>

            <a class="switch-tile box" href="/calculadora-matriz-main/sistemas-lineares/metodo_gauss.php">
                <figure class="image is-128x128 mb-3">
                    <img src="img/1739515.png" alt="Gauss">
                </figure>
                <p class="has-text-weight-bold">Gauss</p>
            </a>

            <a class="switch-tile box" href="/calculadora-matriz-main/sistemas-lineares/metodo_cramer.php">
                <figure class="image is-128x128 mb-3">
                    <img src="img/1739515.png" alt="Cramer">
                </figure>
                <p class="has-text-weight-bold">Cramer</p>
            </a>

            <a class="switch-tile box"
                href="/calculadora-matriz-main/cofatores-determinante-inversa/cofatores_determinante_inversa.php">
                <figure class="image is-128x128 mb-3">
                    <img src="img/1739515.png" alt="Determinante">
                </figure>
                <p class="has-text-weight-bold">Determinantes</p>
            </a>

            <a class="switch-tile box" href="/calculadora-matriz-main/matrixyz.php">
                <figure class="image is-128x128 mb-3">
                    <img src="img/1739515.png" alt="MatriXYZ">
                </figure>
                <p class="has-text-weight-bold">MatriXYZ</p>
            </a>

            <a class="switch-tile box is-disabled" href="#">
                <figure class="image is-128x128 mb-3">
                    <img src="img/1739515.png" alt="Em breve">
                </figure>
                <p class="has-text-weight-bold">Em breve</p>
            </a>

        </div>
    </div>

    <button class="switch-nav-button is-right" aria-label="Próximo">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>
<?php include_once 'footer.php'; ?>