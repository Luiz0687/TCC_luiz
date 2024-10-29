<?php
require_once "../conecta.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de projeto</title>
</head>
<body>
    <form action="cadastrar.php" method="post">
    Informe o nome do projeto : <input type="text" name="nome"required><br><br>
        <input type="submit" value="cadastrar">
    </form>
</body>
</html>