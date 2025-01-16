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
        //var_dump($dados['usuario_tipo']);die;

        if (password_verify($senha, $dados['senha'])) {

            if ($_SESSION['usuario'][2] == 1) {

                header("location: login/professor/professor.php");

            } else {

                if ($_SESSION['usuario'][2] == 2) {

                    header("location: login/monitor/monitor.php");

                } else {

                    if ($_SESSION['usuario'][2] == 3) {

                        header("location: login/aluno/aluno.php");
                    }
                }
            }

        } else {

            notificacoes(2, "Senha inválida.");
        }
    } else {

        notificacoes(2, "Email está incorreto.");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <style>
       



.login{
	position: absolute;
	top: calc(50% - 120px);
	left: calc(60% - 75px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 3;
	
}

.login input[type=text]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-color: black;
	border-radius: 3px;
	color: black;
	font-size: 15px;
	font-weight: 400;
	padding: 2px;
	margin-top: 10px;
}

.login input[type=password]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-color: black;
	border-radius: 3px;
	color: black;
	font-size: 15px;
	font-weight: 400;
	padding: 2px;
	margin-top: 10px;
}

.login input[type=button]{
	width: 80px;
	height: 35px;
	background: black;
	border: 1px solid #fff;
	border-color: black;
	cursor: pointer;
	border-radius: 2px;
	color: #fff;
	font-size: 16px;
	font-weight: 400;
	padding: 6px;
	margin-left: 176px;
	margin-top: 10px;
}

.login input[type=button]:hover{
	opacity: 0.7;
}

.login input[type=button]:active{
	opacity: 0.4;
}

.login input[type=text]:focus{
	outline: none;
	border: 1px solid rgba(0,0,0,0.2);
}

.login input[type=password]:focus{
	outline: none;
	border: 1px solid rgba(0,0,0,0.2);
}
::-webkit-input-placeholder{
   color: rgba(0,0,0,0.4);
}

::-moz-input-placeholder{
	color: rgba(0,0,0,0.4);
}
    </style>
</head>

<body>

    <?php
    exibirNotificacoes();
    limpaNotificacoes();
    ?>
   <div class="body"></div>
		<div class="grad"></div>
	
        <div class="container"> 
        <a class="brand-logo"><img src="Style/images/logo.svg" style="height: 60px;margin-top: 400px; margin-left: 550px;"></a>
      </div> 
		</div>
		<br>
		<div class="login">
			
			
		<form action="Login/professor/professor.php" method="post">
		Email <br>
				<input type="text" name="email" required><br>
				Senha <br>
				<input type="password" name="senha"required><br>
				<input type="submit" value="Login"><br><br>
		</form>
    <a href="login/cadastrar.php">
        <h4>Não possui um cadastro? Crie um agora mesmo!</h4>
    </a>
    <a href="recuperar_senha/form-recuperar-senha.php">
        <h4>Esqueceu a sua senha?</h4>
    </a>
   
	</div>
</html>
