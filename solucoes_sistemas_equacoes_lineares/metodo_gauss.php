<?php
$size = isset($_POST['size']) ? intval($_POST['size']) : 2;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Método de Gauss</title>
</head>
<body>
    <div class="container">
        <h1>Método de Gauss</h1>
        <form method="post" action="resultado_gauss.php" id="form">
            <input type="hidden" name="size" id="size" value="<?php echo $size; ?>">
            <div id="matriz-container">
                <?php for ($i = 0; $i < $size; $i++): ?>
                    <div>
                        <?php for ($j = 0; $j < $size; $j++): ?>
                            <input type="text" name="a<?php echo $i+1 . $j+1; ?>" 
                                value="<?php echo isset($_POST["a".($i+1).($j+1)]) ? htmlspecialchars($_POST["a".($i+1).($j+1)]) : ''; ?>"> 
                            x<?php echo $j+1; ?>
                            <?php if ($j < $size - 1) echo '+'; ?>
                        <?php endfor; ?>
                        = <input type="text" name="r<?php echo $i+1; ?>" 
                            value="<?php echo isset($_POST["r".($i+1)]) ? htmlspecialchars($_POST["r".($i+1)]) : ''; ?>">
                    </div>
                <?php endfor; ?>
            </div>
            <div class="botoes-box">
                <button type="button" onclick="alterarMatriz('add')">+</button>
                <button type="button" onclick="alterarMatriz('remove')">-</button>
                <button type="button" onclick="limparMatriz()">Limpar</button>
            </div>
            <button type="submit">Resolver</button>
        </form>
        <div class="matrizes">
            <a href="/solucoes_sistemas_equacoes_lineares/solucoes_sistemas_equacoes_lineares.php">Voltar</a>
        </div>
    </div>

    <script src="/js/script_metodo_gauss.js"></script>
</body>
</html>
