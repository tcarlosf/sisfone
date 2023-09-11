<?php
include 'conexao.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Telefonia</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .header {
            background-color: #007bff;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

     
        .header h1 {
           
            display: inline-block;
            vertical-align: middle;
        }

        .header img {
            width: 88px;
            height: 85px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .container {
            max-width: 1055px;
            margin: 20px auto;
            padding: 31px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .menu {
            margin-top: 85px;
            margin-right: 231px;
            margin-bottom: 20px;
            text-align: center;
        }

        .menu a {
            text-align: center;
            width: 132px;
            height: 11px;
            display: inline-block;
            margin: 10px;
            padding: 39px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
        }

        .menu a:hover {
            background-color: #0056b3;
        }

        .btn-pesquisa {
            display: block;
            width: 150px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            margin: 20px auto;
        }

        img {
            height: 500px;
            width: 679px;
            margin-left: 190px;
            margin-top: -5px;
        }

        footer {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 368px;
        }

      

    </style>
</head>
<body>
    <div class="header">
        <img src="imagem/telefone.png" alt="Logo">
        <h1>Sistema de Gerenciamento de Telefones - SGT</h1>
    </div>
   

    <div class="container">
    
        <div class="menu">
        <a href="contratos.php">Contratos</a>
        <a href="cadastrar_telefone.php">Cadastrar Telefone</a>
        <a href="listar_telefones.php">Listar Telefones</a>
        <a href="pesquisa.php" class="btn-pesquisa">Pesquisa</a>
        <a href="gastos.php" class="btn-gastos">Gastos</a>
        <a href="gerar_relatorio.php">Relatório</a>
    </div>

    <div class="image-container">
        <img src="imagem/telefone1.png" alt="Logo1">
    </div>

    
    <footer>
        <p> @SUINF -  Todos os direitos reservados</p>
    </footer>



</body>


</html>
