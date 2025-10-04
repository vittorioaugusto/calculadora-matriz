<link rel="stylesheet" href="/calculadora-matriz-main/css/style_matrizes.css">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $operacao = $_POST['operacao'] ?? '';
    $matrizA = [];
    $matrizB = [];

    // --- Recebe matriz A --- //
    foreach ($_POST['matrizA'] as $i => $linha) {
        foreach ($linha as $j => $valor) {
            $matrizA[intval($i)][intval($j)] = $valor;
        }
    }

    // --- Recebe matriz B --- //
    foreach ($_POST['matrizB'] as $i => $linha) {
        foreach ($linha as $j => $valor) {
            $matrizB[intval($i)][intval($j)] = $valor;
        }
    }

    $vazioA = true;
    $vazioB = true;

    // Detecta se existe pelo menos um valor preenchido
    foreach ($matrizA as $linha) {
        foreach ($linha as $valor) {
            if ($valor !== '' && $valor !== null) {
                $vazioA = false;
                break 2;
            }
        }
    }

    foreach ($matrizB as $linha) {
        foreach ($linha as $valor) {
            if ($valor !== '' && $valor !== null) {
                $vazioB = false;
                break 2;
            }
        }
    }

    if ($vazioA || $vazioB) {
        echo "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
        Swal.fire({
            icon: 'warning',
            title: 'Atenção',
            text: 'Por favor, preencha pelo menos um valor em cada matriz antes de calcular.'
        }).then(() => window.history.back());
        </script>
    </body>
    </html>";
        exit;
    }


    // --- Calcula dimensões --- //
    $linhasA = count($matrizA);
    $colunasA = count($matrizA[0]);
    $linhasB = count($matrizB);
    $colunasB = count($matrizB[0]);

    // --- Verificações de compatibilidade e campos vazios --- //

    // Caso adição ou subtração
    if (($operacao == 'adicao' || $operacao == 'subtracao')) {
        if ($linhasA !== $linhasB || $colunasA !== $colunasB || $vazioA || $vazioB) {
            echo "<!DOCTYPE html>
            <html lang='pt-br'>
            <head>
                <meta charset='UTF-8'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'As matrizes devem ter o mesmo tamanho, o mesmo número de linhas e colunas.'
                }).then(() => window.history.back());
                </script>
            </body>
            </html>";
            exit;
        }
    }

    // Caso multiplicação
    if ($operacao == 'multiplicacao') {
        if ($colunasA !== $linhasB || $vazioA || $vazioB) {
            echo "<!DOCTYPE html>
            <html lang='pt-br'>
            <head>
                <meta charset='UTF-8'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'O número de colunas da matriz da esquerda deve ser igual número de linhas da matriz da direita.'
                }).then(() => window.history.back());
                </script>
            </body>
            </html>";
            exit;
        }
    }

    // --- Converte valores numéricos após validar --- //
    foreach ($matrizA as $i => $linha) {
        foreach ($linha as $j => $valor) {
            $matrizA[$i][$j] = floatval($valor);
        }
    }
    foreach ($matrizB as $i => $linha) {
        foreach ($linha as $j => $valor) {
            $matrizB[$i][$j] = floatval($valor);
        }
    }

    // --- Operações --- //
    $resultado = [];
    $explicacao = "";

    switch ($operacao) {
        case 'adicao':
            $explicacao .= "<p>Soma das matrizes:</p><table class='tabela-operacao'>";
            for ($i = 0; $i < $linhasA; $i++) {
                $explicacao .= "<tr>";
                for ($j = 0; $j < $colunasA; $j++) {
                    $resultado[$i][$j] = $matrizA[$i][$j] + $matrizB[$i][$j];
                    $explicacao .= "<td>{$matrizA[$i][$j]} + {$matrizB[$i][$j]} = {$resultado[$i][$j]}</td>";
                }
                $explicacao .= "</tr>";
            }
            $explicacao .= "</table>";
            break;

        case 'subtracao':
            $explicacao .= "<p>Subtração das matrizes:</p><table class='tabela-operacao'>";
            for ($i = 0; $i < $linhasA; $i++) {
                $explicacao .= "<tr>";
                for ($j = 0; $j < $colunasA; $j++) {
                    $resultado[$i][$j] = $matrizA[$i][$j] - $matrizB[$i][$j];
                    $explicacao .= "<td>{$matrizA[$i][$j]} - {$matrizB[$i][$j]} = {$resultado[$i][$j]}</td>";
                }
                $explicacao .= "</tr>";
            }
            $explicacao .= "</table>";
            break;

        case 'multiplicacao':
            $explicacao .= "<p>Multiplicação de matrizes:</p><table class='tabela-operacao'>";
            for ($i = 0; $i < $linhasA; $i++) {
                $explicacao .= "<tr>";
                for ($j = 0; $j < $colunasB; $j++) {
                    $resultado[$i][$j] = 0;
                    $operacaoTexto = [];
                    for ($k = 0; $k < $colunasA; $k++) {
                        $resultado[$i][$j] += $matrizA[$i][$k] * $matrizB[$k][$j];
                        $operacaoTexto[] = "{$matrizA[$i][$k]}x{$matrizB[$k][$j]}";
                    }
                    $explicacao .= "<td>" . implode(" + ", $operacaoTexto) . " = {$resultado[$i][$j]}</td>";
                }
                $explicacao .= "</tr>";
            }
            $explicacao .= "</table>";
            break;

        default:
            echo "<!DOCTYPE html>
            <html lang='pt-br'>
            <head>
                <meta charset='UTF-8'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                Swal.fire({ icon: 'error', title: 'Erro', text: 'Operação inválida.' })
                .then(() => window.history.back());
                </script>
            </body>
            </html>";
            exit;
    }

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
            <h2>Detalhamento da Operação: <?php echo $nomeOperacao; ?></h2>
            <div class="explicacao">
                <?php echo $explicacao; ?>
            </div>
        </div>

        <div class="resultado">
            <h2>Resultado</h2>
            <div class="matriz-resultado">
                <table class="matriz-table">
                    <?php foreach ($resultado as $linha): ?>
                        <tr>
                            <?php foreach ($linha as $valor): ?>
                                <td><?php echo $valor; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        <div class="botoes-box">
            <a href="operacoes_matrizes.php" class="btn voltar">Voltar</a>
            <a href="../index.php" class="btn">Início</a>
        </div>
    </div>
</section>

<?php include_once '../footer.php'; ?>