<?php
// Dados de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "sisfone";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Prepara os dados para inserção no banco de dados
    $numero_contrato = $_POST['numero_contrato'];
    $contratada = $_POST['contratada'];
    $objeto = $_POST['objeto'];
    $valor_contratual = $_POST['valor_contratual'];
    $saldo = $_POST['saldo'];

    // Insere os dados no banco de dados
    $sql = "INSERT INTO telefone_fixo (numero_contrato, contratada, objeto, valor_contratual, saldo) VALUES ('$numero_contrato', '$contratada', '$objeto', '$valor_contratual', '$saldo')";

    if ($conn->query($sql) === TRUE) {
        echo "Contrato inserido com sucesso!";
    } else {
        echo "Erro ao inserir o contrato: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
