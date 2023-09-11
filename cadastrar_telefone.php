<?php
include 'conexao.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Telefone</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        
        }

        .form-container input[type="text"],
        .form-container input[type="checkbox"] {
            width: 300px;
            padding: 5px;
            margin-bottom: 10px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .checkbox-container label {
            width: 900px;
            margin-right: 10px;
        }

        .form-container .btn-cadastrar {
            display: block;
            width: 281px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            text-align: center;
            cursor: pointer;
            margin-top: 20px;
        }

        .form-container .btn-cadastrar:hover {
            background-color: #45a049;
           
        }

        .form-container a {
            width: 262px;
            display: block;
            margin-top: 10px;
            text-align: center;
        }
        select {
            width: 100px;
            margin-top: 0px;
            margin-bottom: 30px;
        }

        
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
    </style>
</head>
<body>
    <header>
        <h1>Cadastrar Telefone</h1>
    </header>
    <?php
    
    $sql = ""; // Defina a variável $sql com uma string vazia antes do bloco condicional if

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $imei = $_POST['imei'];
        $numero = $_POST['numero'];
        $operadora = $_POST['operadora'];
        $responsavel = $_POST['responsavel'];
        $setor = $_POST['setor']; // Novo campo Setor
        $aparelho_novo = isset($_POST['aparelho_novo']) ? $_POST['aparelho_novo'] : '';
        $aparelho_usado = isset($_POST['aparelho_usado']) ? $_POST['aparelho_usado'] : '';
        $tipo = $_POST['tipo'];

        $sql = "INSERT INTO telefones (marca, modelo, imei, numero, operadora, responsavel, setor, aparelho_novo, aparelho_usado, tipo) VALUES ('$marca', '$modelo', '$imei', '$numero', '$operadora', '$responsavel', '$setor', '$aparelho_novo', '$aparelho_usado', '$tipo')";

        if ($conexao->query($sql) === TRUE) {
            echo "<p class='success-message'>Telefone cadastrado com sucesso!</p>";
        } else {
            echo "<p class='error-message'>Erro ao cadastrar o telefone: " . $conexao->error . "</p>";
        }

        $conexao->close();
    }
    ?>
    <div class="form-container">
        <form action="cadastrar_telefone.php" method="POST">
            <label for="tipo">Tipo:</label><br>
                <select name="tipo">
                    <option value="movel">Móvel</option>
                    <option value="fixo">Fixo</option>
                </select> 
            <label for="marca">Marca</label>
            <input type="text" name="marca" required>
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" required>
            <label for="imei">IMEI</label>
            <input type="text" name="imei" required>
            <label for="numero">Número</label>
            <input type="text" name="numero" required>
            <label for="operadora">Operadora</label>
            <input type="text" name="operadora" required>
            <label for="responsavel">Responsável</label>
            <input type="text" name="responsavel" required>
            <label for="setor">Setor</label> <!-- Novo campo Setor -->
            <input type="text" name="setor" required> <!-- Novo campo Setor -->
            <div class="checkbox-container">
                <input type="checkbox" name="aparelho_novo" value="1">
                <label for="aparelho_novo">Novo</label>
            </div>
            <div class="checkbox-container">
                <input type="checkbox" name="aparelho_usado" value="1">
                <label for="aparelho_usado">Usado</label>
            </div>
            <input type="submit" value="Cadastrar" class="btn-cadastrar">
            <a href="index.php">Voltar</a>
        </form>
    </div>
</body>
</html>
