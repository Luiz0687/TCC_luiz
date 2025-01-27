<?php

require_once "../../notificacao/funcaoNotificacao.php";

require_once "../../conecta.php";

$conexao = conectar();

$id_projeto = $_GET['id_projeto'];

$sql = "UPDATE projeto 
        SET situacao = 'Inativo', 
            data_finalizacao = NOW() 
        WHERE id_projeto = $id_projeto";

$execucao = executarSQL($conexao, $sql);

header("location:../../Login/professor/professor.php");
?>