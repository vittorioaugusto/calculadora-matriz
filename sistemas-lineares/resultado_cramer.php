<?php
include_once '../header.php';

function resolverSistema($matriz, $resultados)
{
    $n = count($matriz);
    $determinantePrincipal = determinante($matriz);

    if ($determinantePrincipal == 0) {
        return [
            'solucoes' => [],
            'passos' => [],
            'erro' => true,
            'mensagem_erro' => "O sistema não possui solução única (determinante = 0), ou seja, ele é impossível ou possui infinitas soluções."
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

<section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Solução do Método de Cramer</h1>

        <?php if (isset($solucaoDetalhada['erro']) && $solucaoDetalhada['erro']): ?>
            <div class="detalhamento">
                <p><strong><?php echo htmlspecialchars($solucaoDetalhada['mensagem_erro']); ?></strong></p>
                <div class="botoes-box">
                    <a href="../sistemas-lineares/metodo_cramer.php" class="button is-link">Voltar à calculadora</a>
                </div>
            </div>
        <?php else: ?>
            <h3 class="subtitle">Passo a Passo da Resolução:</h3>

            <?php foreach ($solucaoDetalhada['passos'] as $index => $passo): ?>
                <div class="detalhamento">
                    <h4>Passo <?php echo $index + 1; ?>: Resolver para x<?php echo $index + 1; ?></h4>
                    <p><strong>Matriz Modificada:</strong></p>
                    <div class="matriz-scroll">
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth tabela-matriz">
                            <tbody>
                                <?php foreach ($passo['matrizModificada'] as $linha): ?>
                                    <tr>
                                        <?php foreach ($linha as $valor): ?>
                                            <td><?php echo number_format($valor, 2); ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <p><strong>Explicação:</strong> <?php echo htmlspecialchars($passo['explicacao']); ?></p>
                    <p><strong>Determinante da Matriz Modificada:</strong> <?php echo number_format($passo['determinanteMatrizModificada'], 4); ?></p>
                    <p><strong>Resultado para x<?php echo $index + 1; ?>:</strong> <span class="has-text-weight-bold has-text-info"><?php echo number_format($passo['solucao'], 4); ?></span></p>
                </div>
            <?php endforeach; ?>

            <div class="resultado">
                <h3 class="subtitle">Resposta Final:</h3>
                <ul>
                    <?php foreach ($solucaoDetalhada['solucoes'] as $index => $valor): ?>
                        <li><strong>x<?php echo $index + 1; ?> = </strong><span class="has-text-weight-bold has-text-primary"><?php echo number_format($valor, 4); ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="botoes-box">
                <a href="../sistemas-lineares/metodo_cramer.php" class="button is-link">Voltar à calculadora</a>
                <a href="../index.php" class="button is-primary">Página Inicial</a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
include_once '../footer.php';
?>