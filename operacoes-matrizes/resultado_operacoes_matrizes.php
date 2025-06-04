<link rel="stylesheet" href="/calculadora-matriz-main/css/style_matrizes.css">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $operacao = $_POST['operacao'] ?? '';
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

    $linhasA = count($matrizA);
    $colunasA = count($matrizA[0]);
    $linhasB = count($matrizB);
    $colunasB = count($matrizB[0]);

    if (($operacao == 'adicao' || $operacao == 'subtracao') && ($linhasA !== $linhasB || $colunasA !== $colunasB)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({ icon: 'error', title: 'Erro', text: 'As matrizes devem ter o mesmo tamanho.' })
        .then(() => window.history.back());
        </script>";
        exit;
    }

    if ($operacao == 'multiplicacao' && $colunasA !== $linhasB) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({ icon: 'error', title: 'Erro', text: 'Colunas de A devem igualar linhas de B para multiplicar.' })
        .then(() => window.history.back());
        </script>";
        exit;
    }

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
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({ icon: 'error', title: 'Erro', text: 'Operação inválida.' })
            .then(() => window.history.back());
            </script>";
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