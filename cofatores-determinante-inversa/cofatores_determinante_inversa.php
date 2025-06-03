<?php
include_once '../header.php';
$size = isset($_POST['size']) ? intval($_POST['size']) : 3;
?>

<link rel="stylesheet" href="/calculadora-matriz-main/css/style_matrizes.css">

<h1 class="has-text-centered has-text-custom-menta main-title"><b>
    Para quem já compreendeu as operações básicas e métodos como Gauss e Cramer, e deseja explorar mais o universo das matrizes!
</b></h1>

<section class="section">
    <div class="container">

        <form method="post" action="resultado_cofatores_determinante_inversa.php" id="form">
            <input type="hidden" name="sizeA" id="sizeA" value="<?php echo $size; ?>">

            <div class="matriz-container matriz-bloco">
                <div class="matriz-scroll">
                    <div id="matriz-container-A" class="mb-4"></div>
                </div>
                <div class="botoes-box">
                    <button type="button" class="button is-custom-menta is-rounded"
                        onclick="alterarMatriz('A', 'add')">+</button>
                    <button type="button" class="button is-custom-menta is-rounded"
                        onclick="alterarMatriz('A', 'remove')">-</button>
                    <button type="button" class="button is-custom-menta is-rounded"
                        onclick="limparMatriz('A')">Limpar</button>
                </div>

            </div>
        </form>

        <div class="botoes-acao">
            <button type="submit" name="acao" value="cofator" class="button is-custom-menta is-rounded">Cofator</button>
            <button type="submit" name="acao" value="determinante" class="button is-custom-menta is-rounded">Determinante</button>
            <button type="submit" name="acao" value="inversa" class="button is-custom-menta is-rounded">Inversa</button>
        </div>

        <div class="botoes-acao">
            <a href="../index.php" class="button is-custom-menta is-rounded">Voltar</a>
        </div>

    </div>
</section>

<script src="../js/script_matriz_unica.js"></script>

<?php include_once '../footer.php'; ?>