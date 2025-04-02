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
    if (($operacao == 'adicao' || $operacao == 'subtracao') && $sizeA !== $sizeB) {
        die("<script>alert('Erro: As matrizes devem ter o mesmo tamanho.'); window.history.back();</script>");
    }
    
    if ($operacao == 'multiplicacao' && $sizeA !== $sizeB) {
        die("<script>alert('Erro: O número de colunas da primeira matriz deve ser igual ao número de linhas da segunda matriz.'); window.history.back();</script>");
    }

    // Realizar operação
    $resultado = [];
    $explicacao = "";
    switch ($operacao) {
        case 'adicao':
            for ($i = 0; $i < $sizeA; $i++) {
                for ($j = 0; $j < $sizeA; $j++) {
                    $resultado[$i][$j] = $matrizA[$i][$j] + $matrizB[$i][$j];
                    $explicacao .= "({$matrizA[$i][$j]} + {$matrizB[$i][$j]}) ";
                }
                $explicacao .= "\n";
            }
            break;
        case 'subtracao':
            for ($i = 0; $i < $sizeA; $i++) {
                for ($j = 0; $j < $sizeA; $j++) {
                    $resultado[$i][$j] = $matrizA[$i][$j] - $matrizB[$i][$j];
                    $explicacao .= "({$matrizA[$i][$j]} - {$matrizB[$i][$j]}) ";
                }
                $explicacao .= "\n";
            }
            break;
        case 'multiplicacao':
            for ($i = 0; $i < $sizeA; $i++) {
                for ($j = 0; $j < $sizeA; $j++) {
                    $resultado[$i][$j] = 0;
                    for ($k = 0; $k < $sizeA; $k++) {
                        $resultado[$i][$j] += $matrizA[$i][$k] * $matrizB[$k][$j];
                        $explicacao .= "({$matrizA[$i][$k]} * {$matrizB[$k][$j]}) ";
                    }
                    $explicacao .= "= {$resultado[$i][$j]} ";
                }
                $explicacao .= "\n";
            }
            break;
        default:
            die("<script>alert('Erro: Operação inválida.'); window.history.back();</script>");
    }
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
        <h1>Resultado de Operações envolvendo Matrizes</h1>
        <h2>Matriz Resultado:</h2>
        <table border="1">
            <?php foreach ($resultado as $linha) { ?>
                <tr>
                    <?php foreach ($linha as $valor) { ?>
                        <td><?php echo $valor; ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
        <h2>Explicação:</h2>
        <pre><?php echo $explicacao; ?></pre>
        <div class="resultado">
            <a href="../index.php">Voltar à página inicial</a>
        </div>
    </div>
</body>

</html>