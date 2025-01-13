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
    <h2><?php
    echo "Bem vindo professor(a)" . $_SESSION['usuario'][0];
    ?></h2>
    <h1>Meus Projetos</h1>
    <h3><a href="../../index.php">Sair</a></h3>
    <h3><a href="../../Crud/crud_perfil/inicial.php">Meu Perfil</a></h3>
    <h3>Nomes</h3>
    <h3>Status</h3>
    <h3>Ações</h3>
    <a href="../../Crud/crud_projeto/formcad.php">Criar novo Projeto</a>
    <hr></hr>

    <?php
    require_once('../../Crud/crud_projeto/listar.php')
    ?>

    

</body>
</html>