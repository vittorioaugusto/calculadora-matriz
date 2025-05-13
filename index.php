<?php
$title = "MatriXYZ";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $title; ?></title>
</head>

<body>
    <header>
        <div class="container">
            <h1>Bem-vindo ao <?php echo $title; ?></h1>
            <p></p>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <a href="operacoes-matrizes/operacoes_matrizes.php" class="btn">Operações envolvendo matrizes</a>
            <a href="operacoes-matrizes/matriz_escalar.php" class="btn">Matriz Escalar</a>
            <a href="solucoes_sistemas_equacoes_lineares/solucoes_sistemas_equacoes_lineares.php" class="btn">Soluções de Sistemas de Equações Lineares</a>
            <a href="#" class="btn">Cofatores, Determinantes e Matriz Inversa</a>
            <a href="#" class="btn">EM BREVE</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Calculadora de Matrizes</p>
        </div>
    </footer>

</body>

</html>