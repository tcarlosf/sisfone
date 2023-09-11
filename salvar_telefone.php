<?php
include 'conexao.php';

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$imei = $_POST['imei'];
$numero = $_POST['numero'];
$operadora = $_POST['operadora'];
$responsavel = $_POST['responsavel'];
$setor = $_POST['setor'];

$sql = "INSERT INTO telefones (marca, modelo, imei, numero, operadora, responsavel, setor) VALUES ('$marca','$modelo','$imei', '$numero', '$operadora', '$responsavel')";

if ($conexao->query($sql) === TRUE) {
    echo "Telefone cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar o telefone: " . $conexao->error;
}

$conexao->close();
?>
