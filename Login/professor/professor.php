<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION)){
    echo " <script>alert('Você não está logado no sistema!');
    window.location.href=window.location.origin +'/TCC/index.php';
    </script>";
      die;
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
    <h1>Página do professor</h1>
    
    <h2><?php
    echo "Bem vindo professor(a)" . $_SESSION['nome'] . "!";
    ?></h2>
   <a href="../../Crud/crud_projeto/">Crud projeto</a><br><br>
   <a href="../../Crud/crud_frequencia/">Crud frequencia</a><br><br>
   <a href="../../Crud/crud_horario/">Crud horario</a><br><br>
   <a href="../../Crud/crud_encontro/">Crud encontro</a><br><br>
   <a href="../../Crud/crud_usuario/designar.php">Designar monitor</a><br><br>
   

<button><a href="../../index.php">Voltar</a></button>

</body>
</html>