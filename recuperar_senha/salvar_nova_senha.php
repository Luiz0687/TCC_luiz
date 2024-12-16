<?php





$email = $_POST['email'];
$token = $_POST['token'];
$senha = $_POST['senha'];
$repetirSenha = $_POST['repetirSenha'];


require_once "../conecta.php";


$mysql = conectar();


$sql = "SELECT * FROM recuperar_senha WHERE email='$email' AND token='$token'";

$resultado = executarSQL($mysql, $sql);

$recuperar = mysqli_fetch_assoc($resultado);

if ($recuperar == null) {

    echo "Email ou token incorreto. Tente fazer um novo pedido de recuperação de senha.";

    die();
} else {

   

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

        echo "Esse pedido de recuperação de senha já foi utilizadoanteriormente! Para recuperar a senha faça um novo pedido de recuperação de senha.";

        die();
    }

    if ($senha != $repetirSenha) {

        echo "A senha que você digitou é diferente da senha que você digitou no repetir senha. Por favor tente novamente!";

        die();
    }

    $nova_senha = password_hash($senha, PASSWORD_ARGON2ID);



    $consulta_usuario = executarSQL($mysql, "SELECT COUNT(*) FROM usuario WHERE email = '$email'");
    $quantidade_usuario = mysqli_fetch_row($consulta_usuario)[0];

    if ($quantidade_usuario != 0) {

        $sql2 = "UPDATE usuario SET senha='$nova_senha' WHERE email='$email'";
        executarSQL($mysql, $sql2);

        $sql3 = "UPDATE recuperar_senha SET usado=1 WHERE email='$email' AND token='$token'";
        executarSQL($mysql, $sql3);

        echo "Nova senha cadastrada com sucesso! Faça o login para acessar o sistema.<br>";

        echo "<a href='../index.php'>Acessar sistema</a>";

        die();
    }
}