<?php

// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();

// Recebe o id do usuário
$id_projeto = $_GET['id_projeto'];
$sql = "SELECT * FROM projeto WHERE id_projeto = $id_projeto";


// Executa o Select
$resultado = mysqli_query($conexao, $sql);

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

<form action="alterar.php" method="GET">

    <h2>Editar cadastro</h2>
    <input type="hidden" name="id_projeto" value="<?php echo $dados['id_projeto'];?>">
    Edite seu nome
    <input type="text" name="nome" value="<?php echo $dados['nome_projeto'];?>"><br>
    <h4>Edite a situação do projeto</h4>
    <input type="radio" name="situacao" value="Inativo">Inativo<br><br>
    <input type="radio" name="situacao" value="Ativo">Ativo<br><br>
    <input type="submit" value="Editar"/><br><br>
    <button><a href="index.php">Voltar</a></button>

</form>
    
</body>
</html>