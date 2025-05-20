<?php
$sizeA = isset($_POST['sizeA']) ? intval($_POST['sizeA']) : 3;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriz Escalar</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header>
        <div class="container">
            <h1>Matriz Escalar</h1>
        </div>
    </header>

    <section class="content">
        <div class="container">
            <form method="post" action="resultado_matriz_escalar.php" onsubmit="return validarMatrizEscalar()">
                <div class="matriz-box">
                    <h2>Matriz</h2>
                    <input type="hidden" name="sizeA" id="sizeA" value="<?php echo $sizeA; ?>">
                    <div id="matriz-container-A"></div>
                    <div class="botoes-box">
                        <button type="button" class="btn" onclick="alterarMatriz('A', 'add')">+</button>
                        <button type="button" class="btn" onclick="alterarMatriz('A', 'remove')">-</button>
                        <button type="button" class="btn limpar" onclick="limparMatriz('A')">Limpar</button>
                    </div>
                </div>

                <div class="escalar-box">
                    <label for="escalar">Multiplicar por:</label>
                    <input type="number" step="any" name="escalar" id="escalar" required>
                </div>

                <button type="submit" class="btn">Calcular</button>
            </form>

            <a href="../index.php" class="btn voltar">Voltar</a>
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
