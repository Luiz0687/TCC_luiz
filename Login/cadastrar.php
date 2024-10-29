<?php
require_once "../conecta.php";
if ($_POST) {

    $nome = $_POST['nome'];

    $email = $_POST['email'];

    $senha = $_POST['senha'];

    $usuario_tipo = $_POST['usuario_tipo'];

    //$novaSenha = password_hash($senha, PASSWORD_ARGON2I);

    $consultaEmail = mysqli_query($conexao, "SELECT COUNT(*) FROM usuario WHERE email = '$email'");
    $quantidadeEmail = mysqli_fetch_row($consultaEmail)[0];

    if ($quantidadeEmail == 0) {
        $sql = "INSERT INTO usuario (senha,email,nome,usuario_tipo) VALUES('$senha','$email','$nome',$usuario_tipo)";
        mysqli_query($conexao, $sql);
        header("location:../index.php");
    } else {
        echo "Esse Email já existe ! ";
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
    <h1> Cadastre-se </h1>
    <form action="" method="post">
    <input type="hidden" name="usuario_tipo" value="3">
        Nome do usuário :<input type="text" name="nome" id="nome" required> <br><br>
        Email :<input type="email" name="email" id="email" required><br><br>
        Senha :<input type="password" name="senha" id="senha" required><br><br>
        <input type="submit" value="Cadastre-se">
    </form><br>
    <a href="index.php"> Voltar</a>
</body>

</html>