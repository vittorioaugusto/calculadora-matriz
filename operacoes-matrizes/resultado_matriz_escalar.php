<link rel="stylesheet" href="/calculadora-matriz-main/css/style_matrizes.css">

<?php
include_once '../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sizeA = intval($_POST['sizeA']);
    $escalar = floatval($_POST['escalar']);

    $matrizA = [];
    $preenchido = false; // Flag para verificar se existe algum valor

    for ($i = 0; $i < $sizeA; $i++) {
        for ($j = 0; $j < $sizeA; $j++) {
            $valor = $_POST["matrizA"]["$i"]["$j"] ?? '';
            if ($valor !== '') $preenchido = true; // Pelo menos um valor preenchido
            $matrizA[$i][$j] = floatval($valor ?: 0); // Se vazio, converte para 0
        }
    }

    if (!$preenchido) {
        echo "<!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
            Swal.fire({
                icon: 'warning',
                title: 'Atenção',
                text: 'Por favor, preencha pelo menos um valor na matriz antes de calcular.'
            }).then(() => window.history.back());
            </script>
        </body>
        </html>";
        exit;
    }

    // --- Cálculo da matriz escalar --- //
    $resultado = [];
    $explicacao = "<p>Cada elemento da matriz foi multiplicado por $escalar:</p>
                   <table border='1' style='border-collapse: collapse; text-align: center;'>";

    for ($i = 0; $i < $sizeA; $i++) {
        $explicacao .= "<tr>";
        for ($j = 0; $j < $sizeA; $j++) {
            $resultado[$i][$j] = $matrizA[$i][$j] * $escalar;
            $explicacao .= "<td>{$matrizA[$i][$j]} × $escalar = {$resultado[$i][$j]}</td>";
        }
        $explicacao .= "</tr>";
    }
    $explicacao .= "</table>";
}
?>


<section class="content">
    <div class="container">
        <div class="detalhamento">
            <h2>Detalhamento</h2>
            <div class="explicacao"><?php echo $explicacao; ?></div>
        </div>

        <div class="resultado">
            <h2>Resultado Final</h2>
            <table class="matriz-table">
                <?php foreach ($resultado as $linha) { ?>
                <tr>
                    <?php foreach ($linha as $valor) { ?>
                    <td><?php echo $valor; ?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </table>
        </div>

        <div class="botoes-box">
            <a href="../operacoes-matrizes/matriz_escalar.php" class="btn voltar">Voltar à calculadora</a>
            <a href="../index.php" class="btn">Página Inicial</a>
        </div>
    </div>
</section>

<?php
    include_once '../footer.php';
?>