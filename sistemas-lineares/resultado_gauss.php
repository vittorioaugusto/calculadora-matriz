<?php
include_once '../header.php';

function mdc($a, $b) {
    return $b == 0 ? $a : mdc($b, $a % $b);
}

function decimalParaFracao($numero) {
    $precisao = 1e-9;
    $denominador = 1;
    while (abs($numero * $denominador - round($numero * $denominador)) > $precisao) {
        $denominador++;
    }
    $numerador = round($numero * $denominador);
    $mdc = mdc($numerador, $denominador);
    return ($numerador / $mdc) . "/" . ($denominador / $mdc);
}

function formatarMatriz($matriz, $resultados) {
    $html = "<table class='tabela-matriz'>";
    foreach ($matriz as $i => $linha) {
        $html .= "<tr>";
        foreach ($linha as $valor) {
            $html .= "<td>" . round($valor, 3) . "</td>";
        }
        $html .= "<td>|</td><td>" . round($resultados[$i], 3) . "</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

function resolverGauss($matriz, $resultados) {
    $n = count($matriz);
    $x = array_fill(0, $n, 0);
    $passos = [];

    for ($i = 0; $i < $n; $i++) {
        $max = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if (abs($matriz[$j][$i]) > abs($matriz[$max][$i])) {
                $max = $j;
            }
        }

        if ($matriz[$max][$i] == 0) {
            throw new Exception("O sistema não tem solução única ou é indeterminado.");
        }

        list($matriz[$i], $matriz[$max]) = [$matriz[$max], $matriz[$i]];
        list($resultados[$i], $resultados[$max]) = [$resultados[$max], $resultados[$i]];
        $passos[] = "Troca de linhas " . ($i + 1) . " e " . ($max + 1) . ":" .
            formatarMatriz($matriz, $resultados);

        for ($j = $i + 1; $j < $n; $j++) {
            $fator = $matriz[$j][$i] / $matriz[$i][$i];
            for ($k = $i; $k < $n; $k++) {
                $matriz[$j][$k] -= $fator * $matriz[$i][$k];
            }
            $resultados[$j] -= $fator * $resultados[$i];
            $passos[] = "Eliminação de x" . ($i + 1) . " na linha " . ($j + 1) . ":" .
                formatarMatriz($matriz, $resultados);
        }
    }

    for ($i = $n - 1; $i >= 0; $i--) {
        $soma = 0;
        for ($j = $i + 1; $j < $n; $j++) {
            $soma += $matriz[$i][$j] * $x[$j];
        }
        $x[$i] = ($resultados[$i] - $soma) / $matriz[$i][$i];
        $passos[] = "Substituindo x" . ($i + 1) . " = " . round($x[$i], 4);
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


<link rel="stylesheet" href="/css/style.css">

<section class="section">
    <div class="container">
        <h1 class="titulo">Solução do Método de Gauss</h1>

        <?php if (isset($erro)): ?>
            <div class="detalhamento erro">
                <p><strong><?php echo $erro; ?></strong></p>
                <div class="botoes-box">
                    <a href="../sistemas-lineares/metodo_gauss.php" class="btn voltar">Voltar à calculadora</a>
                </div>
            </div>
        <?php else: ?>
            <h3>Passo a Passo:</h3>
            <div class="detalhamento">
                <?php foreach ($passos as $index => $passo): ?>
                    <div class="passo">
                        <p><strong>Passo <?php echo $index + 1; ?>:</strong></p>
                        <div><?php echo $passo; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="resultado">
                <h3>Resultado Final:</h3>
                <ul>
                    <?php foreach ($resposta as $index => $valor): ?>
                        <li><strong>x<?php echo $index + 1; ?> =</strong> <?php echo $valor; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="botoes-box">
                <a href="../sistemas-lineares/metodo_gauss.php" class="btn voltar">Voltar à calculadora</a>
                <a href="../index.php" class="btn">Página Inicial</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include_once '../footer.php'; ?>
