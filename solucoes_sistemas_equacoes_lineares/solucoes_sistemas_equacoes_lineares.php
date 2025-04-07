<?php
// index.php
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Escolha o Método</title>
</head>

<body>
    <header>
        <div class="container">
            <h1>Soluções de Sistemas de Equações Lineares</h1>
            <p></p>
        </div>
    </header>


    <section class="hero">
        <div class="container">
            <h1>Escolha um método</h1>
            <a href="metodo_cramer.php" class="btn">Método de Cramer</a>
            <a href="metodo_gauss.php" class="btn">Método de Gauss</a>
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

</body>

</html>