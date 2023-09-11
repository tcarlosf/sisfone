<?php
$conexao = new mysqli('localhost', 'root', '', 'sisfone');

if ($conexao->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}
?>
