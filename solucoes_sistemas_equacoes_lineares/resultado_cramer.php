<?php
function resolverSistema($matriz, $resultados)
{
    $n = count($matriz);
    $determinantePrincipal = determinante($matriz);

    if ($determinantePrincipal == 0) {
        return [
            'solucoes' => "O sistema não possui solução única (determinante = 0), ou seja, ele é impossível ou possui infinitas soluções.",
            'passos' => [],
            'erro' => true
        ];
    }

    $solucoes = [];
    $passos = [];

    for ($i = 0; $i < $n; $i++) {
        $matrizModificada = $matriz;

        for ($j = 0; $j < $n; $j++) {
            $matrizModificada[$j][$i] = $resultados[$j];
        }

        $det = determinante($matrizModificada);
        $solucao = $det / $determinantePrincipal;
        $solucoes[] = $solucao;

        $passos[] = [
            'matrizModificada' => $matrizModificada,
            'determinanteMatrizModificada' => $det,
            'solucao' => $solucao,
            'explicacao' => "Para encontrar x" . ($i + 1) . ", substituímos a coluna " . ($i + 1) . " da matriz original pelos valores da coluna dos resultados. " .
                "Em seguida, calculamos o determinante da matriz modificada e o dividimos pelo determinante da matriz original para obter o valor da incógnita."
        ];
    }

    return ['solucoes' => $solucoes, 'passos' => $passos, 'erro' => false];
}

function determinante($matriz)
{
    $n = count($matriz);
    if ($n == 1) return $matriz[0][0];
    if ($n == 2) return $matriz[0][0] * $matriz[1][1] - $matriz[0][1] * $matriz[1][0];

    $det = 0;
    for ($col = 0; $col < $n; $col++) {
        $submatriz = [];
        for ($i = 1; $i < $n; $i++) {
            $linha = [];
            for ($j = 0; $j < $n; $j++) {
                if ($j != $col) $linha[] = $matriz[$i][$j];
            }
            $submatriz[] = $linha;
        }
        $det += pow(-1, $col) * $matriz[0][$col] * determinante($submatriz);
    }
    return $det;
}

$size = $_POST['size'] ?? 2;
$matriz = [];
$resultados = [];

for ($i = 0; $i < $size; $i++) {
    for ($j = 0; $j < $size; $j++) {
        $matriz[$i][$j] = isset($_POST["a" . ($i + 1) . ($j + 1)]) ? floatval($_POST["a" . ($i + 1) . ($j + 1)]) : 0;
    }
    $resultados[$i] = isset($_POST["r" . ($i + 1)]) ? floatval($_POST["r" . ($i + 1)]) : 0;
}

$solucaoDetalhada = resolverSistema($matriz, $resultados);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Solução do Método de Cramer</title>
</head>

<body>
    <div class="container">
        <h1>Solução do Método de Cramer</h1>
        <div class="detalhamento">
            <?php if (isset($solucaoDetalhada['erro']) && $solucaoDetalhada['erro']): ?>
                <strong>
                    <p><?php echo $solucaoDetalhada['solucoes']; ?></p>
                </strong>
                <a href="/solucoes_sistemas_equacoes_lineares/metodo_cramer.php"><button type="button">Voltar à calculadora</button></a>
        </div>
    <?php else: ?>
        <h3>Passo a Passo da Resolução:</h3>
        <?php foreach ($solucaoDetalhada['passos'] as $index => $passo): ?>
            <div class="detalhamento">
                <h4>Passo <?php echo $index + 1; ?>: Resolver para x<?php echo $index + 1; ?></h4>
                <p><strong>Matriz Modificada:</strong></p>
                <table>
                    <?php foreach ($passo['matrizModificada'] as $linha): ?>
                        <tr>
                            <?php foreach ($linha as $valor): ?>
                                <td><?php echo number_format($valor, 2); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <p><strong>Explicação:</strong> <?php echo $passo['explicacao']; ?></p>
                <p><strong>Determinante da Matriz Modificada:</strong> <?php echo number_format($passo['determinanteMatrizModificada'], 4); ?></p>
                <p><strong>Resultado para x<?php echo $index + 1; ?>:</strong> <?php echo number_format($passo['solucao'], 4); ?></p>
            </div>
        <?php endforeach; ?>
        <div class="resultado">
            <h3>Resposta:</h3>
            <ul>
                <?php foreach ($solucaoDetalhada['solucoes'] as $index => $valor): ?>
                    <li><strong>x<?php echo $index + 1; ?> = </strong><?php echo number_format($valor, 4); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="resultado">
            <a href="../index.php">Voltar à página inicial</a>
        </div>
        </div>
    </div>
</body>

</html>