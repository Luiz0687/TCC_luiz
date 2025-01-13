<?php

require_once "../../notificacao/funcaoNotificacao.php";
//conectar ao banco.
require_once "../../conecta.php";

//variavel de conexão.
$conexao = conectar();

$sql = "SELECT * FROM usuario WHERE id_usuario = " . $_SESSION['usuario'][1];

$query = executarSQL($conexao, $sql);

$usuario = mysqli_fetch_assoc($query);



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
   
        <h1>Bem vindo!</h1>

        <h2><?php echo $_SESSION['usuario'][0]; ?></h2>
<?php

exibirNotificacoes();
limpaNotificacoes();

?>
    <form action="alterarPerfil.php" method="post">

        <label for="nome">Seu nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome'];?>"><br><br>

        <label for="email">Seu email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario['email'];?>"><br><br>

        <input type="submit" value="Alterar perfil"><br><br>

        <button><a href="../../login/professor/professor.php">Voltar</a></button>
    </form>
    
</body>

</html>