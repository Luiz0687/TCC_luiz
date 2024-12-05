<?php
require_once("../../conecta.php");
$conexao = conectar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de projeto</title>
</head>
<body>
    <h1>Cadastro de Frequência</h1>
    
    <form action="cadastrar.php" method="post">
    Informe o nome do projeto : <input type="text" name="nome"required><br><br>
    Data : <input type="date" name="data"required><br><br>
        <input type="submit" value="cadastrar"><br><br>
        <button><a href="index.php">Voltar</a></button>
    </form>
</body>
</html>