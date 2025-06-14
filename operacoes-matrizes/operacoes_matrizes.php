<?php
include_once '../header.php';
$sizeA = isset($_POST['sizeA']) ? intval($_POST['sizeA']) : 3;
$sizeB = isset($_POST['sizeB']) ? intval($_POST['sizeB']) : 3;
?>

<link rel="stylesheet" href="/calculadora-matriz-main/css/style_matrizes.css">

<h1 class="has-text-centered has-text-custom-laranja main-title">
        <b>Desbrave os Cálculos Fundamentais!</b>
</h1>

<section class="section">
    <div class="container">
        <form method="post" action="resultado_operacoes_matrizes.php" id="form" onsubmit="return validarMatrizes()">
            <div id="matrizes-wrapper">
                <div class="matriz-container matriz-bloco" id="bloco-matriz-A">
                    <h2>Matriz A</h2>
                    <input type="hidden" name="sizeA" id="sizeA" value="<?php echo $sizeA; ?>">
                    <div class="matriz-scroll">
                        <div id="matriz-container-A"></div>
                    </div>
                    <div class="botoes-box">
                        <button type="button" class="button is-custom-laranja is-rounded no-shadow"
                            onclick="alterarMatriz('A', 'add')">+</button>
                        <button type="button" class="button is-custom-laranja is-rounded no-shadow"
                            onclick="alterarMatriz('A', 'remove')">-</button>
                        <button type="button" class="button is-custom-laranja is-rounded no-shadow"
                            onclick="limparMatriz('A')">Limpar</button>
                    </div>

                </div>

                <div class="matriz-container matriz-bloco" id="bloco-matriz-B">
                    <h2>Matriz B</h2>
                    <input type="hidden" name="sizeB" id="sizeB" value="<?php echo $sizeB; ?>">
                    <div class="matriz-scroll">
                        <div id="matriz-container-B"></div>
                    </div>
                        <div class="botoes-box">
                            <button type="button" class="button is-custom-laranja is-rounded no-shadow"
                                onclick="alterarMatriz('B', 'add')">+</button>
                            <button type="button" class="button is-custom-laranja is-rounded no-shadow"
                                onclick="alterarMatriz('B', 'remove')">-</button>
                            <button type="button" class="button is-custom-laranja is-rounded no-shadow"
                                onclick="limparMatriz('B')">Limpar</button>
                        </div>
                    
                </div>
            </div>

            <div class="operacao-calculo">
                <div class="field has-addons">
                    <div class="control">
                        <div class="select">
                            <select name="operacao">
                                <option value="adicao">Adição</option>
                                <option value="subtracao">Subtração</option>
                                <option value="multiplicacao">Multiplicação</option>
                            </select>
                        </div>
                    </div>
                    <div class="control">
                        <button type="submit" class="button is-custom-laranja is-rounded">Calcular</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="matrizes">
            <a href="../index.php" class="button is-custom-laranja is-rounded">Voltar</a>
        </div>
    </div>
</section>

<script src="../js/script_operacao_matrizes.js"></script>

<?php include_once '../footer.php'; ?>