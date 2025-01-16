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
    <title>Document</title>
    <style>
       

body{
	margin: 0;
	padding: 0;
	background: #fff;
	color: #fff;
	font-size: 12px;
}

.body{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background-size: cover;
	z-index: 0;
}

.grad{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
	z-index: 1;
	opacity: 0.7;
}

.header{
	position: absolute;
	top: calc(50% - 35px);
	left: calc(50% - 255px);
	z-index: 2;
}

.header div{
	float: left;
	color: #fff;
	font-size: 65px;
	font-weight: 600;
   
}

.header div span{
	color: #5379fa !important;
}

.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(50% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 2;
}

.login input[type=text]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=password]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
	margin-top: 10px;
}

.login input[type=button]{
	width: 260px;
	height: 35px;
	background: #fff;
	border: 1px solid #fff;
	cursor: pointer;
	border-radius: 2px;
	color: #a18d6c;
	font-size: 16px;
	font-weight: 400;
	padding: 6px;
	margin-top: 10px;
}

.login input[type=button]:hover{
	opacity: 0.8;
}

.login input[type=button]:active{
	opacity: 0.6;
}

.login input[type=text]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=button]:focus{
	outline: none;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
    </style>
</head>

<body>
    <h1>Login</h1>

    <?php
    exibirNotificacoes();
    limpaNotificacoes();
    ?>
   <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
        <div class="container"> 
        <a class="brand-logo"><img src="Style/images/logo.svg" style="height: 60px;"></a>
      </div> 
		</div>
		<br>
		<div class="login">
				<input type="text" placeholder="username" name="user"><br>
				<input type="password" placeholder="password" name="password"><br>
				<input type="button" value="Login">
	
        

    <a href="login/cadastrar.php">
        <h4>Não possui um cadastro? Crie um agora mesmo!</h4>
    </a>
    <a href="recuperar_senha/form-recuperar-senha.php">
        <h4>Esqueceu a sua senha?</h4>
    </a>
   
	</div>
</html>
