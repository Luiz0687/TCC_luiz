<?php
require_once "../conecta.php";
if ($_POST) {

    $nome = $_POST['nome'];

    $email = $_POST['email'];

    $senha = $_POST['senha'];

    $usuario_tipo = $_POST['usuario_tipo'];

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
<h1>Cadastre-se</h1>
    <form action="" method="post">
    <input type="hidden" name="usuario_tipo" value="3">
        Nome do usuário :<input type="text" name="nome" id="nome" required> <br><br>
        <label>Email : <input type="email" name="email" required></label><br><br>
        <label>Senha : <input type="password" name="senha" required></label><br><br>
        <input type="submit" value="Cadastre-se"><br><br>
        <a href="../index.php"> Voltar</a>
    </form><br>
</body>
</html>
