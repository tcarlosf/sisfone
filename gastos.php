<?php
include 'conexao.php';

// Função para formatar a data no formato desejado
function formatarData($data) {
    return date('d/m/Y', strtotime($data));
}

// Verificar se o formulário de gastos foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero']) && isset($_POST['valor_gasto'])) {
    $numero = $_POST['numero'];
    $valorGasto = $_POST['valor_gasto'];

    // Inserir os dados na tabela de gastos
    $sql = "INSERT INTO gastos (numero, valor_gasto) VALUES ('$numero', '$valorGasto')";
    $resultado = $conexao->query($sql);
}

// Consulta SQL para recuperar os dados de gastos
$sqlGastos = "SELECT * FROM gastos";
$resultadoGastos = $conexao->query($sqlGastos);

// Consulta SQL para obter o valor total dos gastos
$sqlTotalGastos = "SELECT SUM(valor_gasto) AS total FROM gastos";
$resultadoTotalGastos = $conexao->query($sqlTotalGastos);
$linhaTotalGastos = $resultadoTotalGastos->fetch_assoc();
$totalGastos = $linhaTotalGastos['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gastos Telefônicos</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos CSS */

        /* Estilos para a tabela */
        table {
            width: 100%;
            margin: 20px auto;
           /* background: linear-gradient(to bottom, #007bff, #ffffff);*/
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        tr:hover {
            background-color: #ddd;
        }

        /* Estilos para o formulário de gastos */
        .form-gastos {
            max-width: 210px;
            margin: 20px auto;
            padding: 10px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }

        .form-gastos label {
            display: block;
            margin-bottom: 10px;
            
        }

        .form-gastos input[type="text"],
        .form-gastos input[type="number"] {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
        }

        .form-gastos .btn-registrar {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            text-align: center;
            cursor: pointer;
        }

        .form-gastos .btn-registrar:hover {
            background-color: #0056b3;
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
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <header>
        <h1>Gastos Telefônicos</h1>
    </header>

    <!-- Formulário de gastos -->
    <form class="form-gastos" action="gastos.php" method="POST">
        <label for="numero">Número do Telefone:</label>
        <input type="text" name="numero" required>
        <label for="valor_gasto">Valor Gasto:</label>
        <input type="number" name="valor_gasto" step="0.01" required>
        <input type="submit" value="Registrar" class="btn-registrar">
    </form>

    <!-- Tabela de gastos -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Número do Telefone</th>
                <th>Valor Gasto</th>
                <th>Data de Registro</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultadoGastos && $resultadoGastos->num_rows > 0) {
                while ($row = $resultadoGastos->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['numero'] . "</td>";
                    echo "<td>R$ " . $row['valor_gasto'] . "</td>";
                    echo "<td>" . formatarData($row['data_registro']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum registro de gasto encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Tabela de valor total dos gastos -->
    <table>
        <thead>
            <tr>
                <th>Total de Gastos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>R$ <?php echo $totalGastos; ?></td>
            </tr>
        </tbody>
    </table>

    <a href="index.php" class="btn-voltar">Voltar</a>
</body>
</html>
