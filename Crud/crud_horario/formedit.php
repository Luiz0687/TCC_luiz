<?php
require_once("../../conecta.php");

$id_horario = $_GET['id_horario'];
$sql = "SELECT * FROM horario WHERE id_horario = $id_horario";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);

// Gera o vetor com os dados buscados
$dados = mysqli_fetch_assoc($resultado);
//var_dump($dados);die;   
?>

<!DOCTYPE html>
<html lang="pt_br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar horario</title>
    
</head>
<body>

<form action="alterar.php" method="get">

    <h2>Editar cadastro</h2>
    <input type="hidden" name="id_horario" value="<?php echo $dados['id_horario'] ;?>">
    edite a data
    <input type="date" name="data_" value="<?php echo $dados['data_'];?>"><br><br>
    Edite o horario
    <input type="time" name="horario" value="<?php echo $dados['horario'];?>"><br><br>

    <input type="submit" value="Editar"/>

    <button><a href="index.php">Voltar</a></button>

</form>
    
</body>
</html>