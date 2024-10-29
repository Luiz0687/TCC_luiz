<?php
require_once "../conecta.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label>Administrador<input type="radio" name="nivel" value="1"></label><br>
        <label>Professor<input type="radio" name="nivel" value="2"></label><br>
        <label>Monitor<input type="radio" name="nivel" value="3"></label><br>
        <label>Aluno<input type="radio" name="nivel" value="4"></label><br>
        <label>Nome <input type="text" name="nome"></label><br>
        <label>Email <input type="email" name="email"></label><br>
        <label>Senha <input type="password" name="senha"></label><br>
        <input type="submit" value="Cadastrar">
    </form>


</body>

</html>
<?php
if($_POST){
    $nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$nivel = $_POST['nivel'];

$sql = "INSERT INTO usuario (nome,email,senha,nivel) VALUE ('$nome','$email','$senha','$nivel')";
$sql = mysqli_query($conexao,$sql);

}





?>