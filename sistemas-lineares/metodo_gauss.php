<?php
include_once '../header.php';
$size = isset($_POST['size']) ? intval($_POST['size']) : 2;
?>

<link rel="stylesheet" href="/calculadora-matriz-main/css/style_matrizes.css">
<link rel="stylesheet" href="../css/style_sistemas_lineares.css">

<h1 class="has-text-centered is-size-3 has-text-custom-limao">
        <b>Este é o caminho para a resolução de sistemas!</b>
</h1>

<section class="section">
    <div class="container">

        <form method="post" action="resultado_gauss.php" id="form">
            <input type="hidden" name="size" id="size" value="<?php echo $size; ?>">

            <div class="matriz-wrapper">
                <div class="matriz-scroll-lin">
                <div id="matriz-container"></div>
                </div>
                <div class="botoes-box">
                    <button type="button" class="button is-custom-limao is-rounded" onclick="alterarMatriz('add')">+</button>
                    <button type="button" class="button is-custom-limao is-rounded" onclick="alterarMatriz('remove')">-</button>
                    <button type="button" class="button is-custom-limao is-rounded" onclick="limparMatriz()">Limpar</button>
                </div>
            </div>

            <div class="resolver-box">
                <button type="submit" class="button is-custom-limao is-rounded">Resolver</button>
            </div>

            <div class="botao-voltar">
                <a href="../index.php" class="button is-custom-limao is-rounded">Voltar</a>
            </div>
        </form>
    </div>
</section>

<script src="../js/script_metodo_gauss.js"></script>

<?php
include_once '../footer.php';
?>