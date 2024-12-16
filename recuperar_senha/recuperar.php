<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once "../conecta.php";


$mysql = conectar();


$email = $_POST['email'];


$consulta_usuario = executarSQL($mysql, "SELECT COUNT(*) FROM usuario WHERE email = '$email'");
$quantidade_usuario = mysqli_fetch_row($consulta_usuario)[0];




if ($quantidade_usuario == 0) {
    echo "E-mail: " . " " . $email . " " . " não está cadastrado no sistema!<p><a href = \"../index.php\">Voltar</a></p>";

    die();
} else {



    if ($quantidade_usuario != 0) {


        $sql = "SELECT email, nome FROM usuario WHERE email = '$email'";


        $resultado = executarSQL($mysql, $sql);


        $usuario = mysqli_fetch_assoc($resultado);
    }

    $token = bin2hex(random_bytes(50));


    require_once 'PHPMailer/src/PHPMailer.php';
    require_once 'PHPMailer/src/SMTP.php';


    include 'config2.php';


    $mail = new PHPMailer(true);


    try {

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->setLanguage('br');
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $config['email'];
        $mail->Password = $config['senha_email'];

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilita a criptografia TLS para a conexão SMTP.

        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );


        $mail->setFrom($config['email'], 'Recuperação de senha');
        $mail->addAddress($usuario['email'], $usuario['email']);
        $mail->addReplyTo($config['email'], 'Recuperação de senha');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Recuperação de Senha do Sistema';
        $mail->Body = 'Olá!<br>
                    Você solicitou a recuperação da sua conta no nosso sistema.
                    Para isso, clique no link abaixo para realizar a troca de senha:<br>
                    <a href="' . $_SERVER['SERVER_NAME'] . '/tcc_luiz/recuperar_senha/nova_senha.php?email=' . $usuario['email'] . '&token=' . $token . '">Clique aqui para recuperar o acesso à sua conta!</a><br>
                    <br>
                    Atenciosamente<br>
                    Equipe do sistema...';



        $mail->send();
        echo 'Email enviado com sucesso!<br>Confira o seu email.';

        echo '<p><a href = "../index.php">Voltar para a tela inicial</a></p>';


        date_default_timezone_set('America/Sao_Paulo');
        $data = new DateTime('now');
        $agora = $data->format('Y-m-d H:i:s');
        $sql2 = "INSERT INTO recuperar_senha 
             (email, token, data_criacao, usado)
             VALUES ('" . $usuario['email'] . "', '$token', 
             '$agora', 0)";


        executarSQL($mysql, $sql2);
    } catch (Exception $e) {
        echo "Não foi possível enviar o email. 
          Mailer Error: {$mail->ErrorInfo}";
    }

    die();
}


$token = bin2hex(random_bytes(50));


require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';


include '../config2.php';




$mail = new PHPMailer(true);


try {

    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->setLanguage('br');

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $config['email'];
    $mail->Password = $config['senha_email'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );


    $mail->setFrom($config['email'], 'Recuperação de senha');
    $mail->addAddress($usuario['email'], $usuario['nome']);
    $mail->addReplyTo($config['email'], 'Recuperação de senha'); // Define um endereço de resposta.


    $mail->isHTML(true);
    $mail->Subject = 'Recuperação de Senha do Sistema';
    $mail->Body = 'Olá!<br>
            Você solicitou a recuperação da sua conta no nosso sistema.
            Para isso, clique no link abaixo para realizar a troca de senha:<br>
            <a href="' . $_SERVER['SERVER_NAME'] . '/jeverson-tcc/recuperarSenha/nova_senha.php?email='
        . $usuario['email'] . '&token=' . $token .
        '">Clique aqui para recuperar o acesso à sua conta!</a><br>
            <br>
            Atenciosamente<br>
            Equipe do sistema...';

    $mail->send();
    echo 'Email enviado com sucesso!<br>Confira o seu email.';

    echo '<p><a href = "../index.php">Voltar para a tela inicial</a></p>';


    date_default_timezone_set('America/Sao_Paulo');
    $data = new DateTime('now');
    $agora = $data->format('Y-m-d H:i:s');
    $sql2 = "INSERT INTO recuperar_senha 
             (email, token, data_criacao, usado)
             VALUES ('" . $usuario['email'] . "', '$token', 
             '$agora', 0)";


    executarSQL($mysql, $sql2);
} catch (Exception $e) {
    echo "Não foi possível enviar o email. 
          Mailer Error: {$mail->ErrorInfo}";
}
