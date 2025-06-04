<link rel="stylesheet" href="/calculadora-matriz-main/css/style_matrizes.css">

<?php
include_once '../header.php';

function isSquareMatrix($matrix) {
    $n = count($matrix);
    foreach ($matrix as $row) {
        if (!is_array($row) || count($row) !== $n) {
            return false;
        }
    }
    return true;
}

function getCofactor($matrix, $row, $col) {
    $minor = [];
    foreach ($matrix as $i => $r) {
        if ($i == $row) continue;
        $minorRow = [];
        foreach ($r as $j => $val) {
            if ($j == $col) continue;
            $minorRow[] = $val;
        }
        $minor[] = $minorRow;
    }
    return $minor;
}

function determinant($matrix) {
    $n = count($matrix);
    if ($n == 1) return $matrix[0][0];
    if ($n == 2) return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];

    $det = 0;
    foreach ($matrix[0] as $col => $value) {
        $sign = ($col % 2 == 0) ? 1 : -1;
        $det += $sign * $value * determinant(getCofactor($matrix, 0, $col));
    }
    return $det;
}

function cofatorMatrix($matrix) {
    $n = count($matrix);
    $cofatores = [];
    for ($i = 0; $i < $n; $i++) {
        $cofatores[$i] = [];
        for ($j = 0; $j < $n; $j++) {
            $sign = (($i + $j) % 2 == 0) ? 1 : -1;
            $cofatores[$i][$j] = $sign * determinant(getCofactor($matrix, $i, $j));
        }
    }
    return $cofatores;
}

function transpose($matrix) {
    return array_map(null, ...$matrix);
}

function inverse($matrix) {
    $det = determinant($matrix);
    if (abs($det) < 1e-10) throw new Exception("A matriz não possui inversa (determinante zero).");

    $cof = cofatorMatrix($matrix);
    $adj = transpose($cof);
    $inv = [];

    foreach ($adj as $i => $row) {
        foreach ($row as $j => $val) {
            $inv[$i][$j] = $val / $det;
        }
    }
    return $inv;
}

function renderTable($matrix) {
    $html = "<table border='1' style='border-collapse: collapse; text-align: center; margin-bottom: 10px;'>";
    foreach ($matrix as $row) {
        $html .= "<tr>";
        foreach ($row as $val) {
            $formatted = is_float($val) ? number_format($val, 2) : $val;
            $html .= "<td>{$formatted}</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

function detalharDeterminante($matrix, $linha = 0) {
    $n = count($matrix);
    if ($n == 1) {
        return "<p>Determinante da matriz 1x1: {$matrix[0][0]}</p>";
    }
    if ($n == 2) {
        $det = $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
        return "<p>Determinante 2x2 calculado por regra: ({$matrix[0][0]} × {$matrix[1][1]}) - ({$matrix[0][1]} × {$matrix[1][0]}) = {$det}</p>";
    }

    $html = "<p>Expandindo o determinante pela linha " . ($linha + 1) . ":</p>";
    $det = 0;

    foreach ($matrix[$linha] as $col => $value) {
        $sign = (($linha + $col) % 2 == 0) ? 1 : -1;
        $minor = getCofactor($matrix, $linha, $col);
        $det_minor = determinant($minor);
        $contrib = $sign * $value * $det_minor;
        $det += $contrib;

        $sinal_str = $sign == 1 ? "+" : "-";
        $html .= "<p>Elemento a<sub>{$linha}{$col}</sub> = {$value}, sinal = {$sinal_str}</p>";
        $html .= "<p>Menor (submatriz) excluindo linha {$linha} e coluna {$col}:</p>";
        $html .= renderTable($minor);
        $html .= "<p>Determinante do menor: {$det_minor}</p>";
        $html .= "<p>Contribuição para o determinante: {$sinal_str} {$value} × {$det_minor} = {$contrib}</p><hr>";
    }

    $html .= "<p><strong>Determinante total: {$det}</strong></p>";

    return $html;
}

// Captura dados do formulário
$size = isset($_POST['sizeA']) ? intval($_POST['sizeA']) : 0;
$acao = $_POST['acao'] ?? '';
$matrix = $_POST['matrizA'] ?? [];

foreach ($matrix as $i => $row) {
    foreach ($row as $j => $value) {
        $matrix[$i][$j] = floatval($value);
    }
}

$explicacao = "";
$resultado = [];
?>

<section class="content">
    <div class="container">

        <?php
        try {
            if (!isSquareMatrix($matrix)) throw new Exception("A matriz deve ser quadrada.");

            echo "<div class='detalhamento'>";
            echo "<h2>Detalhamento</h2>";

            switch ($acao) {
                case 'determinante':
                    $det = determinant($matrix);
                    $explicacao = detalharDeterminante($matrix);
                    break;

                case 'inversa':
                    $inv = inverse($matrix);
                    $explicacao .= "<p>A inversa foi obtida pela fórmula:</p>
                    <p><strong>A<sup>-1</sup> = adj(A) / det(A)</strong></p>";
                    $explicacao .= "<p><strong>Determinante:</strong> " . number_format(determinant($matrix), 2) . "</p>";
                    $explicacao .= "<p><strong>Matriz Inversa:</strong></p>" . renderTable($inv);
                    $resultado = $inv;
                    break;

                case 'cofator':
                    $cof = cofatorMatrix($matrix);
                    $explicacao .= "<p>Cada elemento da matriz de cofatores é calculado por:</p>
                    <p><strong>C<sub>ij</sub> = (-1)<sup>i+j</sup> * det(M<sub>ij</sub>)</strong></p>";
                    $explicacao .= "<p><strong>Matriz de Cofatores:</strong></p>" . renderTable($cof);
                    $resultado = $cof;
                    break;

                default:
                    echo "<div class='notification is-warning'>Operação inválida.</div>";
                    exit;
            }

            echo "<div class='explicacao'>{$explicacao}</div>";
            echo "</div>";

            echo "<div class='resultado'>";
            echo "<h2>Resultado Final</h2>";
            if (is_array($resultado)) {
                echo renderTable($resultado);
            } else {
                echo $resultado;
            }
            echo "</div>";

        } catch (Exception $e) {
            echo "<div class='notification is-danger'>Erro: {$e->getMessage()}</div>";
        }
        ?>

        <div class="botao-voltar">
            <a href="cofatores_determinante_inversa.php" class="button is-warning is-rounded">Voltar</a>
        </div>
    </div>
</section>

<?php include_once '../footer.php'; ?>