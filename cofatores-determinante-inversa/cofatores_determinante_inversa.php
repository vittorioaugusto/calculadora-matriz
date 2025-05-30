<?php
include_once '../header.php';
$size = isset($_POST['size']) ? intval($_POST['size']) : 3;
?>

<section class="section">
    <div class="container">

        <form method="post" action="resultado_cofatores_determinante_inversa.php" id="form">
            <input type="hidden" name="sizeA" id="sizeA" value="<?php echo $size; ?>">

            <div class="matriz-box">

                <div id="matriz-container-A" class="mb-4"></div>

                <div class="botoes-box">
                    <button type="button" class="button is-warning is-rounded" onclick="alterarMatriz('A', 'add')">+</button>
                    <button type="button" class="button is-warning is-rounded" onclick="alterarMatriz('A', 'remove')">-</button>
                    <button type="button" class="button is-warning is-rounded" onclick="limparMatriz('A')">Limpar</button>
                </div>

                <div class="buttons">
                    <button type="submit" name="acao" value="determinante" class="button is-warning is-rounded">Determinante</button>
                    <button type="submit" name="acao" value="inversa" class="button is-warning is-rounded">Inversa</button>
                    <button type="submit" name="acao" value="cofator" class="button is-warning is-rounded">Cofator</button>
                </div>
            </div>
        </form>

        <div class="botao-voltar">
            <a href="../index.php" class="button is-warning is-rounded">Voltar</a>
        </div>
    </div>
</section>

<script src="../js/script_matriz_unica.js"></script>

<?php include_once '../footer.php'; ?>
