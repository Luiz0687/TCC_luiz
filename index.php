<?php

session_start();
include_once("conecta.php");

if ($_POST) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];


    //verificar se o email existe no banco de dados.
    $sql = "SELECT * FROM usuario WHERE email = '$email'";

    //excutar o comando $sql_busca.
    $execucao = mysqli_query($conexao, $sql);

    $dados = mysqli_fetch_assoc($execucao);
    $_SESSION['usuario_tipo'] = $dados['usuario_tipo'];
    $user = $dados['nome'];
    $_SESSION['nome'] = $user;

    if ($senha == $dados['senha']) {
        header('location: login/redire.php');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Login</h1>

    <form action="" method="post">
        <label>Email : <input type="email" name="email" id="" required></label><br><br>
        <label>Senha : <input type="password" name="senha" id="" required></label><br><br>
        <input type="submit" value="Login">
        <hr>
    </form>
    <h3>Não tem um cadastro ? Crie um </h3>
    <a href="login/cadastrar.php"> Cadastre-se</a>
</body>

</html>