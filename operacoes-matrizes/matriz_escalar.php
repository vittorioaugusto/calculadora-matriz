<?php
include_once '../header.php';
$sizeA = isset($_POST['sizeA']) ? intval($_POST['sizeA']) : 3;
?>

<link rel="stylesheet" href="/calculadora-matriz-main/css/style_matrizes.css">

<h1 class="has-text-centered has-text-custom-amarelo main-title">
        <b>Multiplique o seu conhecimento!</b>
</h1>

<section class="section">
    <div class="container">

        <form method="post" action="resultado_matriz_escalar.php" onsubmit="return validarMatrizEscalar()">
            <div id="matrizes-wrapper" class="modo-centralizado">
                <div class="matriz-container matriz-bloco" id="bloco-matriz-A">
                    <h2>Matriz</h2>
                    <input type="hidden" name="sizeA" id="sizeA" value="<?php echo $sizeA; ?>">
                    <div class="matriz-scroll">
                        <div id="matriz-container-A"></div>
                    </div>
                    <div class="botoes-box">
                        <button type="button" class="button is-custom-amarelo is-rounded"
                            onclick="alterarMatriz('A', 'add')">+</button>
                        <button type="button" class="button is-custom-amarelo is-rounded"
                            onclick="alterarMatriz('A', 'remove')">-</button>
                        <button type="button" class="button is-custom-amarelo is-rounded"
                            onclick="limparMatriz('A')">Limpar</button>
                    </div>
                </div>

                <!-- Controles abaixo da matriz -->
                <div class="acoes-escalar">
                    <div class="escalar-box">
                        <label for="escalar">Multiplicar por:</label>
                        <input type="number" step="any" name="escalar" id="escalar" required>
                    </div>

                    <div class="botoes-acao">
                        <button type="submit" class="button is-custom-amarelo is-rounded">Calcular</button>
                        <a href="../index.php" class="button is-custom-amarelo is-rounded">Voltar</a>
                    </div>
                </div>
            </div>
        </form>

    </div>
</section>

<script src="../js/script_operacao_matrizes.js"></script>

<?php
include_once '../footer.php';
?>