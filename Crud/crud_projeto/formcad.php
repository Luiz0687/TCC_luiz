<?php

require_once "../../notificacao/funcaoNotificacao.php";

require_once("../../conecta.php");
$conexao = conectar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de projeto</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
    <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
    <link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">
</head>
<body>
    <form action="cadastrar.php" method="post">

    <input type="hidden" name="id_professor" value="<?php echo $_SESSION['usuario'][1] ?>">
    Informe o nome do projeto : <input type="text" name="nome_projeto"required><br>
    <h4>Informe o Status do Projeto.</h4>
    <input type="radio" name="situacao" value="Inativo"required>Inativo<br><br>
    <input type="radio" name="situacao" value="Ativo"required>Ativo<br><br>
        <input type="submit" value="cadastrar">
    </form>
</body>
</html><br>
<button><a href="../../Login/professor/professor.php">Voltar</a></button>