<?php
include 'conexao.php';

// Função para formatar a data no formato desejado
function formatarData($data) {
    return date('d/m/Y', strtotime($data));
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os valores dos filtros de pesquisa
    $marca = $_POST['marca'];
    $nome = $_POST['nome'];
    $numero = $_POST['numero'];

    // Construir a parte da consulta SQL baseada nos filtros selecionados
    $where = "";
    if (!empty($marca)) {
        $where .= "marca = '$marca' AND ";
    }
    if (!empty($nome)) {
        $where .= "responsavel LIKE '%$nome%' AND ";
    }
    if (!empty($numero)) {
        $where .= "numero = '$numero' AND ";
    }

    // Remover o "AND" extra do final da cláusula WHERE
    $where = rtrim($where, " AND ");

    // Construir a consulta SQL
    $sql = "SELECT * FROM telefones";
    if (!empty($where)) {
        $sql .= " WHERE $where";
    }

    // Executar a consulta SQL
    $resultado = $conexao->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pesquisa de Telefone</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos CSS */
        /* ... */

        /* Estilos para a tabela */
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background: linear-gradient(to bottom, #007bff, #ffffff);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
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

        /* ... */
    </style>
</head>
<body>
    <header>
        <h1>Pesquisa de Telefone</h1>
    </header>

    <!-- Formulário de pesquisa -->
    <form class="search-form" action="pesquisa.php" method="POST">
        <label for="marca">Marca:</label>
        <input type="text" name="marca" placeholder="Filtrar por Marca">

        <label for="setor">Setor:</label>
        <input type="text" name="setor" placeholder="Filtrar por Setor">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" placeholder="Filtrar por Nome">

        <label for="numero">Número:</label>
        <input type="text" name="numero" placeholder="Filtrar por Número">

        <input type="submit" value="Pesquisar" class="btn-pesquisar">
    </form><br><br><br>

    <?php if (isset($resultado)) : ?>
        <?php if ($resultado->num_rows > 0) : ?>
            <!-- Tabela de resultados -->
            <table>
                <tr>
                    <th>Modelo</th>
                    <th>IMEI</th>
                    <th>Número</th>
                    <th>Operadora</th>
                    <th>Data</th>
                    <th>Responsável</th>
                    <th>Setor</th>
                </tr>
                <?php while ($linha = $resultado->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $linha['modelo']; ?></td>
                        <td><?php echo $linha['imei']; ?></td>
                        <td><?php echo $linha['numero']; ?></td>
                        <td><?php echo $linha['operadora']; ?></td>
                        <td><?php echo formatarData($linha['data']); ?></td>
                        <td><?php echo $linha['responsavel']; ?></td>
                        <td><?php echo $linha['setor']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>Nenhum resultado encontrado.</p>
        <?php endif; ?>
    <?php endif; ?><br><br>

    <a href="index.php" class="btn-voltar">Voltar</a>
</body>
</html>
