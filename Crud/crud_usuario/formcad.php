<?php
require_once("../../conecta.php");
$conexao = conectar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuario</title>
</head>
<body>
    <form action="cadastrar.php" method="post">
    Insira seu nome : <input type="text" name="nome"required><br><br>
    Informe seu email : <input type="email" name="email" required><br><br>
    Informe sua senha : <input type="password" name="senha" required><br><br>
    Informe seu tipo de usuario : <input type="number" name="usuario_tipo"  required><br><br>
        <input type="submit" value="cadastrar">
        <button><a href="index.php">Voltar</a></button>
        

    </form>
</body>
</html>