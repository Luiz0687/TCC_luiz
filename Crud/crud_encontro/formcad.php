<?php
require_once "../conecta.php";
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
        <input type="text" name="nome" placeholder="informe seu nome" required><br><br>
        <input type="email" name="email" placeholder="informe seu email" required><br><br>
        <input type="password" name="senha" placeholder="informe sua senha" required><br><br>
        <input type="number" name="usuario_tipo" placeholder="informe seu tipo de usuario" required><br><br>
        <input type="submit" value="cadastrar">
        
        
    </form>
</body>
</html>