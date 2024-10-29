<?php
require_once "../conecta.php";
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
    Informe a data do projeto : <input type="date" name="data" required><br><br>
    Informe o horario de inicio do projeto : <input type="text" name="horaInicial"required><br><br>
    Informe o horario final do projeto : <input type="text" name="horaFinal" required><br><br>
        <input type="submit" value="cadastrar">
    </form>
</body>
</html>