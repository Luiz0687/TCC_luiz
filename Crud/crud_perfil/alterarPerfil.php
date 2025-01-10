<?php

require_once "../../notificacao/funcaoNotificacao.php";

//conectar ao banco.
require_once "../../conecta.php";
//variavel de conexão.
$mysql = conectar();

//receber os dados.
$nome = $_POST['nome'];
$email = $_POST['email'];

 //verificar se o email existe no banco de dados.
 $consulta_usuario = executarSQL($mysql, "SELECT COUNT(*) FROM usuario WHERE email = '$email'");
 $quantidade_usuario = mysqli_fetch_row($consulta_usuario)[0];

 if ($quantidade_usuario != 0) {

    notificacoes(2, "O email já existe no sistema!");

    header("location:../inicial.php");

     die();
     
 } else {

     $sql2 = "UPDATE usuario SET nome = '$nome', email = '$email' WHERE id_usuario = " . $_SESSION['usuario'][1];

     executarSQL($mysql, $sql2);

     $_SESSION['usuario'][0] = $nome;

     notificacoes(1, "Alterações realizadas com sucesso!");

     header("location:inicial.php");
 }