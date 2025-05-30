<?php
include_once '../header.php';
$size = isset($_POST['size']) ? intval($_POST['size']) : 2;
?>

<section class="section">
    <div class="container">

        <form method="post" action="resultado_cramer.php" id="form">
            <input type="hidden" name="size" id="size" value="<?php echo $size; ?>">

            <div class="matriz-wrapper">
                <div id="matriz-container"></div>
            </div>

            <div class="botoes-box">
                <button type="button" class="button is-success is-rounded" onclick="alterarMatriz('add')">+</button>
                <button type="button" class="button is-success is-rounded" onclick="alterarMatriz('remove')">-</button>
                <button type="button" class="button is-success is-rounded" onclick="limparMatriz()">Limpar</button>
            </div>

            <div class="resolver-box">
                <button type="submit" class="button is-success is-rounded">Resolver</button>
            </div>

            <div class="botao-voltar">
                <a href="../index.php" class="button is-success is-rounded">Voltar</a>
            </div>
        </form>
    </div>
</section>

<script src="../js/script_metodo_cramer.js"></script>

<?php
include_once '../footer.php';
?>