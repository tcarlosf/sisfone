<?php
include 'conexao.php';

// Função para formatar valores monetários
function formatarValor($valor) {
    return "R$ " . number_format($valor, 2, ',', '.');
}

// Função para formatar números inteiros
function formatarNumero($numero) {
    return number_format($numero, 0, ',', '.');
}

// Gerar relatório de total de telefones móveis e fixos por departamento, incluindo valor gasto por telefone
function gerarRelatorioDepartamentos() {
    global $conexao;

    $sql = "SELECT setor, 
               COUNT(CASE WHEN tipo = 'movel' THEN 1 END) AS total_moveis, 
               COUNT(CASE WHEN tipo = 'fixo' THEN 1 END) AS total_fixos 
        FROM telefones 
        GROUP BY setor";

    $resultado = $conexao->query($sql);
    if (!$resultado) {
        echo "Erro na consulta: " . $conexao->error;
        return;
    }

    echo "<h2>Por Setor</h2>";
    echo "<table>";
    echo "<thead>";
    echo "<tr><th>Setor</th><th>Total de Móveis</th><th>Total de Fixos</th><th>Valor Gasto por Telefone</th></tr>";
    echo "</thead>";
    echo "<tbody>";

    if ($resultado && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['setor'] . "</td>";
            echo "<td>" . $row['total_moveis'] . "</td>";
            echo "<td>" . $row['total_fixos'] . "</td>";

            // Consultar valor gasto por telefone
            $setor = $row['setor'];
            $sqlValorGasto = "SELECT SUM(valor_gasto) AS total_gasto FROM telefones WHERE setor = '$setor'";
            $resultadoValorGasto = $conexao->query($sqlValorGasto);
            $rowValorGasto = $resultadoValorGasto->fetch_assoc();
            $valorGasto = $rowValorGasto['total_gasto'];

            echo "<td>" . formatarValor($valorGasto) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum registro encontrado.</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";
}



// Gerar relatório de valor médio gasto por telefone
function gerarRelatorioValorMedio() {
    global $conexao;

    $sql = "SELECT AVG(valor_gasto) AS valor_medio FROM gastos";
    $resultado = $conexao->query($sql);
    $row = $resultado->fetch_assoc();
    $valorMedio = $row['valor_medio'];

    echo "<h2>Valor Médio Gasto por Telefone</h2>";
    echo "<p>O valor médio gasto por telefone é de " . formatarValor($valorMedio) . ".</p>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerar Relatórios</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos CSS */

        /* Estilos para os relatórios */
        h2 {
            margin-top: 30px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Estilos para o botão Voltar */
        .btn-voltar {
            display: block;
            width: 100px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
        }

        .btn-voltar:hover {
            background-color: #0056b3;
        }
        
        /* Estilos para o botão Imprimir */
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-imprimir {
            display: block;
            width: 100px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;

        }
        .btn-imprimir:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <header>
        <h1>Gerar Relatórios</h1>
    </header>
    <?php
    gerarRelatorioDepartamentos();
    gerarRelatorioValorMedio();
    ?>
    <a href="index.php" class="btn-voltar">Voltar</a>
    <button class="btn-imprimir" onclick="window.print()">Imprimir</button>
</body>
</html>
