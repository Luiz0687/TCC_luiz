<?php
require_once "../notificacao/funcaoNotificacao.php";
require_once "../conecta.php";
$conexao = conectar();
$mensagem = '';

if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $repetirSenha = $_POST['repetir_senha'];
    $usuario_tipo = $_POST['usuario_tipo'];

    if ($senha === $repetirSenha) {
        $novaSenha = password_hash($senha, PASSWORD_ARGON2I);

        $consultaEmail = mysqli_query($conexao, "SELECT COUNT(*) FROM usuario WHERE email = '$email'");
        $quantidadeEmail = mysqli_fetch_row($consultaEmail)[0];

        if ($quantidadeEmail == 0) {
            $sql = "INSERT INTO usuario (senha, email, nome, usuario_tipo) VALUES('$novaSenha', '$email', '$nome', $usuario_tipo)";
            mysqli_query($conexao, $sql);
            $mensagem = 'Usuário cadastrado com sucesso!';
            // Não redirecionar imediatamente, exibir a mensagem primeiro
        } else {
            $mensagem = 'Esse email já existe!';
        }
    } else {
        $mensagem = 'As senhas não correspondem!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script>
        function mostrarMensagem(mensagem) {
            if (mensagem) {
                alert(mensagem);
            }
        }
    </script>
</head>
<body>
    <h1>Cadastre-se</h1>
    <form action="" method="post">
        <input type="hidden" name="usuario_tipo" value="3">
        Nome do usuário: <input type="text" name="nome" id="nome" required> <br><br>
        <label>Email: <input type="email" name="email" required></label><br><br>
        <label>Senha: <input type="password" name="senha" required></label><br><br>
        <label>Repetir Senha: <input type="password" name="repetir_senha" required></label><br><br>
        <input type="submit" value="Cadastre-se"><br><br>
        <a href="../index.php">Voltar</a>
    </form><br>

    <script>
        // Passa a mensagem do PHP para o JavaScript
        mostrarMensagem("<?php echo $mensagem; ?>");
    </script>

    <?php
    // Redireciona após exibir a mensagem
    if ($mensagem === 'Usuário cadastrado com sucesso!') {
        echo "<script>window.location.href = '../index.php';</script>";
    }
    ?>
</body>
</html>
