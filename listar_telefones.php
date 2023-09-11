<?php
include 'conexao.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listar Telefone</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .table-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Listar Telefone</h1>
    </header>

    <?php
    // Consulta para obter os aparelhos cadastrados em ordem decrescente por marca
    $sql = "SELECT * FROM telefones ORDER BY marca DESC";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<div class='table-container'>";
        echo "<table class='phone-table'>";
        echo "<tr><th>Marca</th><th>Modelo</th><th>IMEI</th><th>Operadora</th><th>Número</th><th>Responsável</th><th>Setor</th><th>Estado do Aparelho</th></tr>";

        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $linha['marca'] . "</td>";
            echo "<td>" . $linha['modelo'] . "</td>";
            echo "<td>" . $linha['imei'] . "</td>";
            echo "<td>" . $linha['operadora'] . "</td>";
            echo "<td>" . $linha['numero'] . "</td>";
            echo "<td>" . $linha['responsavel'] . "</td>";
            echo "<td>" . $linha['setor'] . "</td>";
            echo "<td>";

            if ($linha['aparelho_novo'] == '1') {
                echo "Aparelho Novo";
            } elseif ($linha['aparelho_usado'] == '1') {
                echo "Aparelho Usado";
            } else {
                echo "N/A";
            }

            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";

        // Consulta para obter a contagem dos aparelhos cadastrados por marca
        $sql_count = "SELECT marca, COUNT(*) AS total FROM telefones GROUP BY marca";
        $resultado_count = $conexao->query($sql_count);

        if ($resultado_count->num_rows > 0) {
            echo "<div class='table-container'>";
            echo "<table class='phone-table'>";
            echo "<tr><th>Marca</th><th>Total</th></tr>";

            while ($linha_count = $resultado_count->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $linha_count['marca'] . "</td>";
                echo "<td>" . $linha_count['total'] . "</td>";
                echo "</tr>";
            }

            // Consulta para obter o total geral de aparelhos cadastrados
            $sql_total_geral = "SELECT COUNT(*) AS total_geral FROM telefones";
            $resultado_total_geral = $conexao->query($sql_total_geral);

            if ($resultado_total_geral->num_rows > 0) {
                $linha_total_geral = $resultado_total_geral->fetch_assoc();
                $total_geral = $linha_total_geral['total_geral'];

                // Exibir linha com o total geral dos aparelhos
                echo "<tr>";
                echo "<td><strong>Total Geral</strong></td>";
                echo "<td><strong>$total_geral</strong></td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "</div>";
        }
    } else {
        echo "Nenhum telefone encontrado.";
    }

    $conexao->close();
    ?>

    <a href="index.php" class="btn-voltar">Voltar</a>
    <button onclick="window.print()" class="btn-imprimir">Imprimir</button>
</body>
</html>
