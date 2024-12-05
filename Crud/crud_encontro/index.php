<?php
require_once("../../conecta.php");
$conexao = conectar();
?>
<!DOCTYPE html>
<htm lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crud</title>
    </head>
    <b>
        <h1>Encontro</h1>

        <a href="formcad.php">

            <h3>Cadastrar os encontros</h3>
        </a>

        <a href="listar.php"><h3>Ver os encontros</h3></a>
    </b>
    <button><a href="../../login/professor/professor.php">Voltar</a></button>