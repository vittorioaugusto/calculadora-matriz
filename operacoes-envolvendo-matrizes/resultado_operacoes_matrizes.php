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
        die("<script>alert('Erro: As matrizes devem ter o mesmo número de linhas e colunas.'); window.history.back();</script>");
    }

    if ($operacao == 'multiplicacao' && $sizeA !== $sizeB) {
        die("<script>alert('Erro: O número de colunas da primeira matriz deve ser igual ao número de linhas da segunda matriz.'); window.history.back();</script>");
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
            die("<script>alert('Erro: Operação inválida.'); window.history.back();</script>");
    }

    // Mapeia a operação para um nome legível
    $nomesOperacoes = [
        'adicao' => 'Adição',
        'subtracao' => 'Subtração',
        'multiplicacao' => 'Multiplicação'
    ];

    // Obtém o nome da operação, se existir
    $nomeOperacao = $nomesOperacoes[$operacao] ?? 'Desconhecida';
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Resultado da Operação</title>
</head>

<body>
    <div class="container">
        <h1>Resultado da Operação: <?php echo $nomeOperacao; ?></h1>
        <div class="detalhamento">
            <h2>Cálculo:</h2>
            <pre><?php echo $explicacao; ?></pre>
        </div>
        <div class="resultado">
            <h3>Resposta:</h3>
            <table border="1">
                <?php foreach ($resultado as $linha) { ?>
                    <tr>
                        <?php foreach ($linha as $valor) { ?>
                            <td><?php echo $valor; ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="resultado">
            <a href="../index.php">Voltar à página inicial</a>
        </div>
    </div>
</body>

</html>