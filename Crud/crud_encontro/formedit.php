<?php

// Recebe o id do usuário


// Conectar ao BD
require_once("../../conecta.php");

$id_encontro = $_GET['id_encontro'];
// Seleciona os dados do usuário da tabela
$sql = "SELECT * FROM encontro WHERE id_encontro = '$id_encontro'";

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
    <title>Editar encontro</title>
    
</head>
<body>

<form action="alterar.php" method="get">

    <h2>Editar cadastro</h2>
    <input type="hidden" name="id_encontro" value="<?php echo $dados['id_encontro'];?>">
    edite a descricao
    <input type="text" name="descricao" value="<?php echo $dados['descricao'];?>"><br><br>
    edite a data
    <input type="date" name="data" value="<?php echo $dados['data'];?>"><br><br>
    Edite o horario
    <input type="time" name="horario" value="<?php echo $dados['horario'];?>"><br><br>
    edite o nome do encontro
    <input type="text" name="nome_encontro" value="<?php echo $dados['nome_encontro'];?>"><br><br>

    <input type="submit" value="Editar"/>

    <button><a href="index.php">Voltar</a></button>

</form>
    
</body>
</html>