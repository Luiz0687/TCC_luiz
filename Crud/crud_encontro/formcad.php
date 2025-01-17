<?php
require_once("../../conecta.php");
$conexao = conectar();

$id_projeto = $_GET['id_projeto'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de encontro</title>

    <link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
    <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
    <link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">
    
</head>

<body>
    <form action="cadastrar.php" method="post">
        Informe a data do encontro : <input type="date" name="data" required><br><br>
        Informe o CH do encontro : <input type="number" name="CH" required><br><br>
        <input type="hidden" value="<?php echo $id_projeto ?>" name="id_projeto">
        <input type="submit" value="cadastrar"><br><br>
        <button><a href="../../Crud/crud_encontro/listar.php?id_projeto=<?php echo $id_projeto; ?>">Voltar</a></button>
       
    </form>
</body>

</html>