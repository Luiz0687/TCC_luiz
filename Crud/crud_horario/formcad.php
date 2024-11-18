<?php
require_once "../../conecta.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de horario</title>
</head>
<body>
    <form action="cadastrar.php" method="post">
    Informe a data do projeto : <input type="date" name="data_" required><br><br>
    Informe o horario do projeto : <input type="time" name="horario"required><br><br>
        <input type="submit" value="cadastrar">
        <button><a href="index.php">Voltar</a></button>
    </form>
</body>
</html>