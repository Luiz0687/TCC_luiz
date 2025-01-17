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
    <title>Perfil</title>

    <link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
    <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
    <link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">

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