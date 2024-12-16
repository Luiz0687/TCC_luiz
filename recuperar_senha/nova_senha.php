<?php


$email = $_GET['email'];
$token = $_GET['token'];


require_once "../conecta.php";


$mysql = conectar();


$sql = "SELECT * FROM recuperar_senha WHERE email='$email' AND token='$token'";


$resultado = executarSQL($mysql, $sql);

//atribuir a variavél recuperar ($recuperar) os valores retornados da execução do comando $sql.
$recuperar = mysqli_fetch_assoc($resultado);


if ($recuperar == null) {

    echo "Email ou token incorreto. Tente fazer um novo pedido de recuperação de senha.";

    die();
} else {

    // verificar a validade do pedido (data_criacao).
    // verificar se o link já foi.

    date_default_timezone_set('America/Sao_Paulo'); 

    $agora = new DateTime('now');

    $data_criacao = DateTime::createFromFormat('Y-m-d H:i:s', $recuperar['data_criacao']);

    $umDia = DateInterval::createFromDateString('1 day');

    $dataExpiracao = date_add($data_criacao, $umDia); 


    if ($agora > $dataExpiracao) {

        echo "Essa solicitação de recuperação de senha expirou! Faça um novo pedido de recuperação de senha.";

        die();
    }

    
    if ($recuperar['usado'] == 1) {

        echo "Esse pedido de recuperação de senha já foi utilizado anteriormente! Para recuperar a senha faça um novo pedido de recuperação de senha.<p><a href = \"../index.php\">Voltar</a></p>";

        die();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--Import materialize.css-->
    <!--<link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Senha</title>
</head>

<body>
    <form action="salvar_nova_senha.php" method="post">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="token" value="<?= $token ?>">Email: <?= $email ?><br><br>

        <label for="senha">Senha:
            <input type="password" name="senha" id="senha"></label><br><br>

        <label for="repet">Repita a senha:
            <input type="password" name="repetirSenha" id="repet"></label><br><br>

        <input type="submit" value="Salvar nova senha">
    </form>

    <!--Import jQuery before materialize.js-->
    <!--<script type="text/javascript" src="js/materialize.min.js"></script>-->
</body>

</html>