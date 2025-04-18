<?php
// Função para calcular o máximo divisor comum (MDC)
function mdc($a, $b)
{
    return $b == 0 ? $a : mdc($b, $a % $b);
}

// Função para converter um número decimal em fração
function decimalParaFracao($numero)
{
    $precisao = 1e-9;
    $denominador = 1;
    while (abs($numero * $denominador - round($numero * $denominador)) > $precisao) {
        $denominador++;
    }
    $numerador = round($numero * $denominador);
    $mdc = mdc($numerador, $denominador);
    return ($numerador / $mdc) . "/" . ($denominador / $mdc);
}

// Função para resolver um sistema de equações lineares pelo método de eliminação de Gauss
function resolverGauss($matriz, $resultados)
{
    $n = count($matriz);
    $x = array_fill(0, $n, 0);
    $passos = [];

    for ($i = 0; $i < $n; $i++) {
        // Pivotamento parcial para evitar erros numéricos
        $max = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if (abs($matriz[$j][$i]) > abs($matriz[$max][$i])) {
                $max = $j;
            }
        }
        if ($matriz[$max][$i] == 0) {
            throw new Exception("O sistema não tem solução única ou é indeterminado.");
        }

        // Troca de linhas
        list($matriz[$i], $matriz[$max]) = [$matriz[$max], $matriz[$i]];
        list($resultados[$i], $resultados[$max]) = [$resultados[$max], $resultados[$i]];

        $passos[] = "Matriz após troca de linhas ($i e $max): " . json_encode($matriz);

        // Eliminação
        for ($j = $i + 1; $j < $n; $j++) {
            $fator = $matriz[$j][$i] / $matriz[$i][$i];
            for ($k = $i; $k < $n; $k++) {
                $matriz[$j][$k] -= $fator * $matriz[$i][$k];
            }
            $resultados[$j] -= $fator * $resultados[$i];
            $passos[] = "Eliminando x$i da linha $j: " . json_encode($matriz);
        }
    }

    // Substituição retroativa
    for ($i = $n - 1; $i >= 0; $i--) {
        $soma = 0;
        for ($j = $i + 1; $j < $n; $j++) {
            $soma += $matriz[$i][$j] * $x[$j];
        }
        $x[$i] = ($resultados[$i] - $soma) / $matriz[$i][$i];
        $passos[] = "Substituindo x$i: " . json_encode($x);
    }

    $xFracao = array_map('decimalParaFracao', $x);
    return [$xFracao, $passos];
}

$size = isset($_POST['size']) ? intval($_POST['size']) : 2;
$matriz = [];
$resultados = [];
for ($i = 0; $i < $size; $i++) {
    for ($j = 0; $j < $size; $j++) {
        $matriz[$i][$j] = isset($_POST["a" . ($i + 1) . ($j + 1)]) ? floatval($_POST["a" . ($i + 1) . ($j + 1)]) : 0;
    }
    $resultados[$i] = isset($_POST["r" . ($i + 1)]) ? floatval($_POST["r" . ($i + 1)]) : 0;
}

try {
    list($resposta, $passos) = resolverGauss($matriz, $resultados);
} catch (Exception $e) {
    $erro = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solução do Método de Gauss</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <header>
        <div class="container">
            <h1>Solução do Método de Gauss</h1>
        </div>
    </header>

    <section class="content">
        <div class="container">

            <?php if (isset($erro)): ?>
                <div class="detalhamento">
                    <p><strong><?php echo $erro; ?></strong></p>
                    <div class="botoes-box">
                        <a href="/solucoes_sistemas_equacoes_lineares/metodo_gauss.php" class="btn voltar">Voltar à calculadora</a>
                    </div>
                </div>
            <?php else: ?>
                <h3>Passo a Passo da Resolução:</h3>

                <div class="detalhamento">
                    <ul>
                        <?php foreach ($passos as $index => $passo): ?>
                            <li><strong>Passo <?php echo $index + 1; ?>:</strong> <?php echo htmlspecialchars($passo); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="resultado">
                    <h3>Resposta:</h3>
                    <ul>
                        <?php foreach ($resposta as $index => $valor): ?>
                            <li><strong>x<?php echo $index + 1; ?> = </strong><?php echo $valor; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="botoes-box">
                    <a href="/solucoes_sistemas_equacoes_lineares/metodo_gauss.php" class="btn voltar">Voltar à calculadora</a>
                    <a href="../index.php" class="btn">Página Inicial</a>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Calculadora de Matrizes</p>
        </div>
    </footer>

</body>

</html>