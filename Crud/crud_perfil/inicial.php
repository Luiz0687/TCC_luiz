<?php

//iniciar a session.
session_start();

session_regenerate_id(true);

if (!isset($_SESSION['usuario'][1])) {
   
    header("location:index.php");

    die ();
}
//conectar ao banco.
require_once "../../conecta.php";

//variavel de conexão.
$conexao = conectar();

$sql = "SELECT * FROM usuario WHERE id_usuario = " . $_SESSION['usuario'][1];

$query = executarSQL($conexao, $sql);

$usuario = mysqli_fetch_assoc($query);

$pasta = "foto/";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .div2 {
            border-radius: 10px;
            position: absolute;
            height: 10%;
            width: 5%;
            border: 1px black solid;
            top: 40px;
            left: 30px;
        }
        img {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        form {
            position: absolute;
            top: 25%;
        }

        .bbbb {
            position: absolute;
            margin: auto;
            left: 10%;
            top: 1%;
        }
        .a{
            position: absolute;
            top: 18%;
        }
        .a2{
            position: absolute;
            top: 47%;
        }
    </style>
</head>

<body>
   <!--

    
    <div class="div2">
        <img src="<?php //echo $pasta . $usuario['foto_perfil']; ?>" alt="foto de perfil do usuario.">
    </div>
   -->

    

    <div class="bbbb">
        <h1>Bem vindo!</h1>

        <h2><?php echo $_SESSION['usuario'][0]; ?></h2>
    </div>

    <a class="a" href="crud/trocarImg.php">Configurações da foto de perfil.</a>

    <form action="crud/alterarPerfil.php" method="post">
        <label for="nome">Seu nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome'];?>"><br><br>

        <label for="email">Seu email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario['email'];?>"><br><br>

        <input type="submit" value="Alterar perfil"><br><br>

        <button><a href="crud/excluirPerfil.php">Excluir sua conta</a></button>
    </form>

    <a class="a2" href="logout.php">Sair da sua conta</a>
    
</body>

</html>