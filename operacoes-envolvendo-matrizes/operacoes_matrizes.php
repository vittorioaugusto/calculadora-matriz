<?php
$sizeA = isset($_POST['sizeA']) ? intval($_POST['sizeA']) : 3;
$sizeB = isset($_POST['sizeB']) ? intval($_POST['sizeB']) : 3;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Operações com Matrizes</title>
</head>

<body>
    <header>
        <div class="container">
            <h1>Operações envolvendo matrizes</h1>
        </div>
    </header>

    <section class="content">
        <div class="container">
            <form method="post" action="resultado_operacoes_matrizes.php" id="form" onsubmit="return validarMatrizes()">
                <div class="matrizes">
                    <div class="matriz-box">
                        <h2>Matriz A</h2>
                        <input type="hidden" name="sizeA" id="sizeA" value="<?php echo $sizeA; ?>">
                        <div id="matriz-container-A"></div>
                        <div class="botoes-box">
                            <button type="button" class="btn" onclick="alterarMatriz('A', 'add')">+</button>
                            <button type="button" class="btn" onclick="alterarMatriz('A', 'remove')">-</button>
                            <button type="button" class="btn limpar" onclick="limparMatriz('A')">Limpar</button>
                        </div>
                    </div>
                    <div class="matriz-box">
                        <h2>Matriz B</h2>
                        <input type="hidden" name="sizeB" id="sizeB" value="<?php echo $sizeB; ?>">
                        <div id="matriz-container-B"></div>
                        <div class="botoes-box">
                            <button type="button" class="btn" onclick="alterarMatriz('B', 'add')">+</button>
                            <button type="button" class="btn" onclick="alterarMatriz('B', 'remove')">-</button>
                            <button type="button" class="btn limpar" onclick="limparMatriz('B')">Limpar</button>
                        </div>
                    </div>
                </div>
                <select name="operacao">
                    <option value="adicao">Adição</option>
                    <option value="subtracao">Subtração</option>
                    <option value="multiplicacao">Multiplicação</option>
                </select>
                <button type="submit" class="btn">Calcular</button>
            </form>
            <div class="matrizes">
                <a href="../index.php" class="btn voltar">Voltar</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Calculadora de Matrizes</p>
        </div>
    </footer>

    <script src="/js/script_operacao_matrizes.js"></script>
</body>

</html>