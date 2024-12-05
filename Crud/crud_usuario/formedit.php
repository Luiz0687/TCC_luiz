<?php

// Recebe o id do usuário


// Conectar ao BD
require_once("../conecta.php");

$id_usuario = $_GET['id_usuario'];

// Seleciona os dados do usuário da tabela
$sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);

// Gera o vetor com os dados buscados
$dados = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="pt_br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cadastro</title>
    
</head>
<body>

<form action="alterar.php" method="get">

    <h2>Editar cadastro</h2>
    <input type="hidden" name="id_usuario" value="<?php echo $dados['id_usuario'];?>">

    Edite seu nome
    <input  type="text" value="<?php echo $dados['nome'];?>" name="nome"/><br><br>

    Edite seu email
    <input  type="text" value="<?php echo $dados['email'];?>" name="email"/><br><br>
   
    Edite seu tipo de usuario :<br><br>
    <label>Professor<input  type="radio" value="1" name="usuario_tipo"required/></label><br><br>

    <label>Monitor<input  type="radio" value="2" name="usuario_tipo" required/></label><br><br>

    <label>Aluno<input  type="radio" value="3" name="usuario_tipo"required/></label><br><br>

    <input type="submit" value="Editar"/><br><br>

    <button><a href="designar.php">Voltar</a></button>   

</form>
    
</body>
</html>