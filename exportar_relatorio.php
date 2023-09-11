<?php
include 'conexao.php';

// Obter os valores dos filtros do URL
$periodoInicio = $_GET['periodo_inicio'];
$periodoFim = $_GET['periodo_fim'];
$operadora = $_GET['operadora'];

// Construir a consulta SQL baseada nos filtros
$sql = "SELECT * FROM telefones WHERE 1=1";
if (!empty($periodoInicio)) {
    $sql .= " AND data >= '$periodoInicio'";
}
if (!empty($periodoFim)) {
    $sql .= " AND data <= '$periodoFim'";
}
if (!empty($operadora)) {
    $sql .= " AND operadora = '$operadora'";
}

// Executar a consulta SQL
$resultado = $conexao->query($sql);

// Configurar o cabeçalho para download do arquivo CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename=relatorio.csv');

// Criar um arquivo temporário para escrever os dados
$temp = fopen('php://temp', 'w');

// Escrever os dados da consulta no arquivo CSV
if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        fputcsv($temp, $linha);
    }
}

// Voltar para o início do arquivo temporário
rewind($temp);

// Ler o conteúdo do arquivo temporário e exibir como saída
echo stream_get_contents($temp);

// Fechar o arquivo temporário e encerrar a execução
fclose($temp);
exit;
?>
