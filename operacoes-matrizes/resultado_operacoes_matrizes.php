<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sizeA = intval($_POST['sizeA']);
    $sizeB = intval($_POST['sizeB']);
    $operacao = $_POST['operacao'];

    // Carregar matrizes
    $matrizA = [];
    $matrizB = [];
    for ($i = 0; $i < $sizeA; $i++) {
        for ($j = 0; $j < $sizeA; $j++) {
            $matrizA[$i][$j] = floatval($_POST["matrizA"]["$i"]["$j"] ?? 0);
        }
    }
    for ($i = 0; $i < $sizeB; $i++) {
        for ($j = 0; $j < $sizeB; $j++) {
            $matrizB[$i][$j] = floatval($_POST["matrizB"]["$i"]["$j"] ?? 0);
        }
    }

    // Verifica compatibilidade das matrizes
    if (($operacao == 'adicao' || $operacao == 'subtracao') &&
        (count($matrizA) !== count($matrizB) || count($matrizA[0]) !== count($matrizB[0]))
    ) {
        echo "
        <!DOCTYPE html>
        <html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <title>Erro</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'As matrizes devem ter o mesmo número de linhas e colunas.'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
        exit;
    }

    if ($operacao == 'multiplicacao' && $sizeA !== $sizeB) {
        echo "
        <!DOCTYPE html>
        <html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <title>Erro</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'O número de colunas da primeira matriz deve ser igual ao número de linhas da segunda matriz.'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
        exit;
    }

    // Realizar operação
    $resultado = [];
    $explicacao = "";
    switch ($operacao) {
        case 'adicao':
            $explicacao .= "<p>A soma das matrizes é realizada somando os elementos correspondentes:</p>";
            $explicacao .= "<table border='1' style='border-collapse: collapse; text-align: center;'>\n";
            for ($i = 0; $i < $sizeA; $i++) {
                $explicacao .= "<tr>\n";
                for ($j = 0; $j < $sizeA; $j++) {
                    $resultado[$i][$j] = $matrizA[$i][$j] + $matrizB[$i][$j];
                    $explicacao .= "<td>{$matrizA[$i][$j]} + {$matrizB[$i][$j]} = {$resultado[$i][$j]}</td>\n";
                }
                $explicacao .= "</tr>\n";
            }
            $explicacao .= "</table>\n";
            break;

        case 'subtracao':
            $explicacao .= "<p>A subtração das matrizes é realizada subtraindo os elementos correspondentes:</p>";
            $explicacao .= "<table border='1' style='border-collapse: collapse; text-align: center;'>\n";
            for ($i = 0; $i < $sizeA; $i++) {
                $explicacao .= "<tr>\n";
                for ($j = 0; $j < $sizeA; $j++) {
                    $resultado[$i][$j] = $matrizA[$i][$j] - $matrizB[$i][$j];
                    $explicacao .= "<td>{$matrizA[$i][$j]} - {$matrizB[$i][$j]} = {$resultado[$i][$j]}</td>\n";
                }
                $explicacao .= "</tr>\n";
            }
            $explicacao .= "</table>\n";
            break;

        case 'multiplicacao':
            $explicacao .= "<p>A multiplicação de matrizes segue a regra de multiplicar cada linha da primeira matriz pela coluna correspondente da segunda matriz.</p>";
            $explicacao .= "<table border='1' style='border-collapse: collapse; text-align: center;'>\n";
            for ($i = 0; $i < $sizeA; $i++) {
                $explicacao .= "<tr>\n";
                for ($j = 0; $j < $sizeA; $j++) {
                    $resultado[$i][$j] = 0;
                    $detalhesOperacao = "";
                    for ($k = 0; $k < $sizeA; $k++) {
                        $produto = $matrizA[$i][$k] * $matrizB[$k][$j];
                        $resultado[$i][$j] += $produto;
                        $detalhesOperacao .= "{$matrizA[$i][$k]} × {$matrizB[$k][$j]}";
                        if ($k < $sizeA - 1) {
                            $detalhesOperacao .= " + ";
                        }
                    }
                    $detalhesOperacao .= " = {$resultado[$i][$j]}";
                    $explicacao .= "<td>$detalhesOperacao</td>\n";
                }
                $explicacao .= "</tr>\n";
            }
            $explicacao .= "</table>\n";
            break;

        default:
            echo "
            <!DOCTYPE html>
            <html lang='pt-BR'>
            <head>
                <meta charset='UTF-8'>
                <title>Erro</title>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Operação inválida.'
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>";
            exit;
    }

    // Mapeia a operação para um nome legível
    $nomesOperacoes = [
        'adicao' => 'Adição',
        'subtracao' => 'Subtração',
        'multiplicacao' => 'Multiplicação'
    ];

    $nomeOperacao = $nomesOperacoes[$operacao] ?? 'Desconhecida';
}
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Operação</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header>
        <div class="container">
            <h1>Resultado da Operação: <?php echo $nomeOperacao; ?></h1>
        </div>
    </header>

    <section class="content">
        <div class="container">
            <div class="detalhamento">
                <h2>Detalhamento do Cálculo</h2>
                <div class="explicacao">
                    <?php echo $explicacao; ?>
                </div>
            </div>

            <div class="resultado">
                <h2>Resultado</h2>
                <div class="matriz-resultado">
                    <table class="matriz-table">
                        <?php foreach ($resultado as $linha) { ?>
                            <tr>
                                <?php foreach ($linha as $valor) { ?>
                                    <td><?php echo $valor; ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>

            <div class="botoes-box">
                <a href="/operacoes-matrizes/operacoes_matrizes.php" class="btn voltar">Voltar à calculadora</a>
                <a href="../index.php" class="btn">Página Inicial</a>
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