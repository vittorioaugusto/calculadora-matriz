<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calculadora de Matrizes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/calculadora-matriz-main/css/style.css">

</head>

<body class="has-navbar-fixed-top">
    <nav class="navbar is-light is-fixed-top" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/calculadora-matriz-main/index.php">
                <img src="/calculadora-matriz-main/img/icon1.png" alt="Logo" />
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item button is-custom-laranja is-rounded" href="/calculadora-matriz-main/operacoes-matrizes/operacoes_matrizes.php">Operações Básicas</a>
                <a class="navbar-item button is-custom-amarelo is-rounded" href="/calculadora-matriz-main/operacoes-matrizes/matriz_escalar.php">Multiplicação por Escalar</a>
                <a class="navbar-item button is-custom-limao is-rounded" href="/calculadora-matriz-main/sistemas-lineares/metodo_gauss.php">Método de Gauss</a>
                <a class="navbar-item button is-custom-verdeclaro is-rounded" href="/calculadora-matriz-main/sistemas-lineares/metodo_cramer.php">Método de Cramer</a>
                <a class="navbar-item button is-custom-menta is-rounded" href="/calculadora-matriz-main/cofatores-determinante-inversa/cofatores_determinante_inversa.php">Cofatores, Determinantes e Matriz Inversa</a>
                <a class="navbar-item button is-custom-violeta is-rounded" href="matrixyz.php">MatriXYZ</a>
                <a class="navbar-item button is-custom-rosa is-rounded" href="#">Em breve!</a>

            </div>
        </div>
    </nav>

    <section class="section">
        <div class="container is-fluid">