<?php

// Função para obter o cofator de uma matriz
function getCofactor($matrix, $row, $col) {
    $size = count($matrix);
    $cofactor = [];
    
    for ($i = 0; $i < $size; $i++) {
        if ($i == $row) continue;
        
        $cofactorRow = [];
        for ($j = 0; $j < $size; $j++) {
            if ($j == $col) continue;
            $cofactorRow[] = $matrix[$i][$j];
        }
        
        $cofactor[] = $cofactorRow;
    }
    return $cofactor;
}

// Função para calcular o determinante de uma matriz
function determinant($matrix) {
    $size = count($matrix);
    if ($size == 1) return $matrix[0][0];
    if ($size == 2) return ($matrix[0][0] * $matrix[1][1]) - ($matrix[0][1] * $matrix[1][0]);

    $det = 0;
    for ($col = 0; $col < $size; $col++) {
        $sign = ($col % 2 == 0) ? 1 : -1;
        $det += $sign * $matrix[0][$col] * determinant(getCofactor($matrix, 0, $col));
    }
    return $det;
}

// Função para calcular a matriz inversa
function inverse($matrix) {
    $size = count($matrix);
    $det = determinant($matrix);
    
    if ($det == 0) {
        throw new Exception("Esta matriz não possui inversa.");
    }

    $cofactorMatrix = [];
    for ($i = 0; $i < $size; $i++) {
        $cofactorMatrix[$i] = [];
        for ($j = 0; $j < $size; $j++) {
            $sign = (($i + $j) % 2 == 0) ? 1 : -1;
            $cofactorMatrix[$i][$j] = $sign * determinant(getCofactor($matrix, $i, $j));
        }
    }
    
    // Transposição da matriz de cofatores
    $adjugate = [];
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            $adjugate[$i][$j] = $cofactorMatrix[$j][$i];
        }
    }
    
    // Multiplica pelo inverso do determinante
    $inverseMatrix = [];
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            $inverseMatrix[$i][$j] = $adjugate[$i][$j] / $det;
        }
    }
    
    return $inverseMatrix;
}

// Função para imprimir a matriz
function printMatrix($matrix) {
    foreach ($matrix as $row) {
        echo implode(" ", array_map(fn($val) => number_format($val, 2), $row)) . "\n";
    }
    echo "\n";
}

// Exemplo de uso
$matrix = [
    [1, 2, 3],
    [0, 4, 5],
    [1, 0, 6]
];

echo "Determinante: " . determinant($matrix) . "\n\n";

try {
    echo "Matriz Inversa:\n";
    printMatrix(inverse($matrix));
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}
?>