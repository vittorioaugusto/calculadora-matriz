<?php
function resolverSistema($matriz, $resultados) {
    $n = count($matriz);
    $determinantePrincipal = determinante($matriz);
    if ($determinantePrincipal == 0) {
        return [
            'solucoes' => "O sistema não possui solução única (determinante = 0).",
            'passos' => []
        ];
    }

    $solucoes = [];
    $passos = [];
    
    for ($i = 0; $i < $n; $i++) {
        $matrizModificada = $matriz;
        // Substitui a coluna da matriz pela coluna dos resultados
        for ($j = 0; $j < $n; $j++) {
            $matrizModificada[$j][$i] = $resultados[$j];
        }
        
        $det = determinante($matrizModificada);
        $solucoes[] = $det / $determinantePrincipal;

        $passos[] = [
            'matrizModificada' => $matrizModificada,
            'determinanteMatrizModificada' => $det,
            'solucao' => $det / $determinantePrincipal,
            'explicacao' => "Substituímos a coluna " . ($i + 1) . " da matriz original pela coluna dos resultados. " .
                            "Agora, a matriz modificada contém os valores do sistema de equações, e o determinante da matriz modificada é calculado para determinar a solução. " .
                            "Após calcular o determinante da matriz modificada, dividimos o valor do determinante obtido pelo determinante da matriz original para encontrar o valor da incógnita x" . ($i + 1) . "."
        ];
    }
    
    return ['solucoes' => $solucoes, 'passos' => $passos];
}

function determinante($matriz) {
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
        $matriz[$i][$j] = isset($_POST["a".($i+1).($j+1)]) ? floatval($_POST["a".($i+1).($j+1)]) : 0;
    }
    $resultados[$i] = isset($_POST["r".($i+1)]) ? floatval($_POST["r".($i+1)]) : 0;
}

$solucaoDetalhada = resolverSistema($matriz, $resultados);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Passo a Passo da Solução</title>
</head>
<body>
    <div class="container">
        <h1>Passo a Passo da Solução</h1>
        
        <div class="detalhamento">
            <h3>Resultado:</h3>
            <?php if (isset($solucaoDetalhada['solucoes']) && is_array($solucaoDetalhada['solucoes'])): ?>
                <ul>
                    <?php foreach ($solucaoDetalhada['solucoes'] as $index => $valor): ?>
                        <li><strong>x<?php echo $index + 1; ?> = </strong><?php echo number_format($valor, 2); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p><?php echo $solucaoDetalhada['solucoes']; ?></p>
            <?php endif; ?>
        </div>
        
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

                <p><strong>Explicação da Modificação:</strong> <?php echo $passo['explicacao']; ?></p>
                
                <p><strong>Determinante da Matriz Modificada:</strong> <?php echo number_format($passo['determinanteMatrizModificada'], 2); ?></p>
                <p><strong>Resultado para x<?php echo $index + 1; ?>:</strong> <?php echo number_format($passo['solucao'], 2); ?></p>
            </div>
        <?php endforeach; ?>
        
        <div class="resultado">
            <a href="../index.php">Voltar à página inicial</a>
        </div>
    </div>
</body>
</html>
