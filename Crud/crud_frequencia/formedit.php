<?php

// Recebe o id do usuário


// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();


// Seleciona os dados do usuário da tabela
$sql = "SELECT * FROM projeto";

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
    
    <link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
    <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
    <link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">
</head>
<body>

<form action="alterar.php" method="get">

    <h2>Editar cadastro</h2>
    <input type="hidden" name="id_projeto" value="<?php echo $dados['id_projeto'];?>">
    Edite seu nome
    <input type="text" name="nome" value="<?php echo $dados['nome_projeto'];?>">
    <input type="submit" value="Editar"/>
    <p> <button href="index.php">Voltar</button>

</form>
    
</body>
</html>