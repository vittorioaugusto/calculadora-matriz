<?php
$size = isset($_POST['size']) ? intval($_POST['size']) : 2;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método de Cramer</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <header>
        <div class="container">
            <h1>Método de Cramer</h1>
        </div>
    </header>

    <section class="content">
        <div class="container">
            <form method="post" action="resultado_cramer.php" id="form">
                <input type="hidden" name="size" id="size" value="<?php echo $size; ?>">

                <div class="matriz-wrapper">
                    <div id="matriz-container"></div>
                </div>

                <div class="botoes-box">
                    <button type="button" class="btn" onclick="alterarMatriz('add')">+</button>
                    <button type="button" class="btn" onclick="alterarMatriz('remove')">-</button>
                    <button type="button" class="btn limpar" onclick="limparMatriz()">Limpar</button>
                </div>

                <button type="submit" class="btn principal">Resolver</button>

                <div class="matrizes">
                    <a href="/solucoes_sistemas_equacoes_lineares/solucoes_sistemas_equacoes_lineares.php" class="btn voltar">Voltar</a>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Calculadora de Matrizes</p>
        </div>
    </footer>

    <script src="/js/script_metodo_cramer.js"></script>
</body>

</html>