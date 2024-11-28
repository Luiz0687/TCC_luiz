<?php

// verificar o email
// verificar o token
$email = $_GET['email'];
$token = $_GET['token'];
require_once "conexao.php";
$conexao = conectar();
$sql = "SELECT * FROM `recuperar-senha` WHERE email = '$email' AND token = '$token'";
$resultado = mysqli_query($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);
if ($recuperar == null) {
    echo "email ou token incorreto ";
    die();
} else {
    /* verificar a validade do pedido e verificar se o link ja foi usado */
    date_default_timezone_set('America/Sao_Paulo');
    $agora = new DateTime('now');
    $data_criacao = DateTime::createFromFormat('Y-m-d H:i:s', $recuperar['data_criacao']);
    echo $recuperar['data_criacao'];
    $umDia = DateInterval::createFromDateString('1 day');
    $dataExpiracao = date_add($data_criacao, $umDia);

    if ($agora > $dataExpiracao) {
        echo "Essa solicitação de recuperação de senha expirou! <br>Faça um novo pedido de recuperação de senha</br>";
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Senha</title>
</head>

<body>
    <form action="salvar-nova-senha.php" method="post">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="token" value="<?= $token ?>">
        Email: <?= $email ?><br>
        <label>Senha:<input name="senha" type="password"></label><br>
        <label>Repita a Senha:<input name="repetirSenha" type="password"></label><br><br>
        <input type="submit" value="Salvar Senha">
    </form>
</body>

</html>