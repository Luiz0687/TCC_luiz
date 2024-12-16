<?php
  if(!isset($_SESSION)){
    session_start();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Página do monitor</h1>
    
    <h2><?php
     echo "Olá monitor" . " " . $_SESSION['usuario'][0];
    ?></h2>
    <a href="../../index.php">Sair</a>
</body>
</html>