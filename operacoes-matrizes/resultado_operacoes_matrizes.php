<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Carrega a operação
    $operacao = $_POST['operacao'] ?? '';

    // Carregar matrizes dinamicamente
    $matrizA = [];
    $matrizB = [];

    foreach ($_POST['matrizA'] as $i => $linha) {
        foreach ($linha as $j => $valor) {
            $matrizA[intval($i)][intval($j)] = is_numeric($valor) ? floatval($valor) : 0;
        }
    }
    foreach ($_POST['matrizB'] as $i => $linha) {
        foreach ($linha as $j => $valor) {
            $matrizB[intval($i)][intval($j)] = is_numeric($valor) ? floatval($valor) : 0;
        }
    }

    // Determina dimensões reais das matrizes
    $linhasA = count($matrizA);
    $colunasA = count($matrizA[0]);
    $linhasB = count($matrizB);
    $colunasB = count($matrizB[0]);

    // Verifica compatibilidade das matrizes
    if (($operacao == 'adicao' || $operacao == 'subtracao') &&
        ($linhasA !== $linhasB || $colunasA !== $colunasB)
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

    if ($operacao == 'multiplicacao' && $colunasA !== $linhasB) {
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
            for ($i = 0; $i < $linhasA; $i++) {
                $explicacao .= "<tr>\n";
                for ($j = 0; $j < $colunasA; $j++) {
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
            for ($i = 0; $i < $linhasA; $i++) {
                $explicacao .= "<tr>\n";
                for ($j = 0; $j < $colunasA; $j++) {
                    $resultado[$i][$j] = $matrizA[$i][$j] - $matrizB[$i][$j];
                    $explicacao .= "<td>{$matrizA[$i][$j]} - {$matrizB[$i][$j]} = {$resultado[$i][$j]}</td>\n";
                }
                $explicacao .= "</tr>\n";
            }
            $explicacao .= "</table>\n";
            break;

        case 'multiplicacao':
            $explicacao .= "<p>A multiplicação de matrizes é feita multiplicando linhas da Matriz A por colunas da Matriz B.</p>";
            $explicacao .= "<table border='1' style='border-collapse: collapse; text-align: center;'>\n";
            for ($i = 0; $i < $linhasA; $i++) {
                $explicacao .= "<tr>\n";
                for ($j = 0; $j < $colunasB; $j++) {
                    $resultado[$i][$j] = 0;
                    $detalhesOperacao = "";
                    for ($k = 0; $k < $colunasA; $k++) {
                        $produto = $matrizA[$i][$k] * $matrizB[$k][$j];
                        $resultado[$i][$j] += $produto;
                        $detalhesOperacao .= "{$matrizA[$i][$k]} × {$matrizB[$k][$j]}";
                        if ($k < $colunasA - 1) {
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

<?php include_once '../header.php'; ?>

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
            <a href="../operacoes-matrizes/operacoes_matrizes.php" class="btn voltar">Voltar à calculadora</a>
            <a href="../index.php" class="btn">Página Inicial</a>
        </div>
    </div>
</section>

<?php include_once '../footer.php'; ?>