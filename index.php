<?php
include_once("notificacao/funcaoNotificacao.php");
include_once("conecta.php");
$conexao = conectar();

if ($_POST) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //verificar se o email existe no banco de dados.
    $sql = "SELECT * FROM usuario WHERE email = '$email'";

    //excutar o comando $sql_busca.
    $execucao = mysqli_query($conexao, $sql);

    $quantidade = $execucao->num_rows;

    if ($quantidade != 0) {
        
    $dados = mysqli_fetch_assoc($execucao);

    $_SESSION['usuario'][0] = $dados['nome'];
    $_SESSION['usuario'][1] = $dados['id_usuario'];
    $_SESSION['usuario'][2] = $dados['usuario_tipo'];

    if (password_verify($senha, $dados['senha'])) {
        header('location: login/redire.php');
    }else {

        notificacoes(2,"Senha inválida.");
    }
    }else {
        
        notificacoes(2,"Email está incorreto.");
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

    <?php
    exibirNotificacoes();

    limpaNotificacoes();
    ?>
    <form action="" method="post">
        <label>Email : <input type="email" name="email" id="" required></label><br><br>
        <label>Senha : <input type="password" name="senha" id="" required></label><br><br>
        <input type="submit" value="Login">
        <hr>
    </form>

    <a href="login/cadastrar.php"><h4>Não possui um cadastro? Crie um agora mesmo!</h4></a>
    <a href="recuperar_senha/form-recuperar-senha.php"><h4>Esqueceu a sua senha?</h4></a>
    <h4>
   Professor<br>
    email - luiz@luiz<br>
    senha - 1 <br>
    <hr>
    Monitor <br>
    email - jeverson@jeverson<br>
    senha - 1<br>
    <hr>
    Aluno <br>
    email - roberto@roberto<br>
    senha - 1<br>
<hr>


</h4>
</body>

</html>


