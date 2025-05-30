<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calculadora de Matrizes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css" />
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
                <a class="navbar-item button is-link is-rounded" href="/calculadora-matriz-main/operacoes-matrizes/operacoes_matrizes.php">Operações Básicas</a>
                <a class="navbar-item button is-primary is-rounded" href="/calculadora-matriz-main/operacoes-matrizes/matriz_escalar.php">Multiplicação por Escalar</a>
                <a class="navbar-item button is-info is-rounded" href="/calculadora-matriz-main/sistemas-lineares/metodo_gauss.php">Método de Gauss</a>
                <a class="navbar-item button is-success is-rounded" href="/calculadora-matriz-main/sistemas-lineares/metodo_cramer.php">Método de Cramer</a>
                <a class="navbar-item button is-warning is-rounded" href="#">Cofatores, Determinantes e Matriz Inversa</a>
                <a class="navbar-item button is-danger is-rounded" href="#">Em Breve!</a>
            </div>
        </div>
    </nav>

    <section class="section">
        <div class="container">