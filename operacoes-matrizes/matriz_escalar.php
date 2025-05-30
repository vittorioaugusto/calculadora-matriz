<?php
include_once '../header.php';
$sizeA = isset($_POST['sizeA']) ? intval($_POST['sizeA']) : 3;
?>

<section class="section">
    <div class="container">

        <form method="post" action="resultado_matriz_escalar.php" onsubmit="return validarMatrizEscalar()">
            <div class="matriz-box">
                <h2>Matriz</h2>
                <input type="hidden" name="sizeA" id="sizeA" value="<?php echo $sizeA; ?>">
                
                <div id="matriz-container-A"></div>
                
                <div class="botoes-box">
                    <button type="button" class="button is-primary is-rounded" onclick="alterarMatriz('A', 'add')">+</button>
                    <button type="button" class="button is-primary is-rounded" onclick="alterarMatriz('A', 'remove')">-</button>
                    <button type="button" class="button is-primary is-rounded" onclick="limparMatriz('A')">Limpar</button>
                </div>
            </div>

            <div class="escalar-calculo">
                <div class="escalar-box">
                    <label for="escalar">Multiplicar por:</label>
                    <input type="number" step="any" name="escalar" id="escalar" required>
                </div>

                <button type="submit" class="button is-primary is-rounded">Calcular</button>
            </div>
        </form>

        <div class="botao-voltar">
            <a href="../index.php" class="button is-primary is-rounded">Voltar</a>
        </div>
    </div>
</section>

<script src="../js/script_operacao_matrizes.js"></script>

<?php
include_once '../footer.php';
?>