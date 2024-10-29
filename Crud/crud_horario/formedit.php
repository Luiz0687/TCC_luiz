<?php

// Recebe o id do usuário


// Conectar ao BD
require_once("../conecta.php");


// Seleciona os dados do usuário da tabela
$sql = "SELECT * FROM horario";

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
    <title>Editar horario</title>
    
</head>
<body>

<form action="alterar.php" method="get">

    <h2>Editar cadastro</h2>
    <input type="text" name="horaInicio" value="<?php echo $dados['horaInicio'];?>">
    edite seu horario de inicio
    <input type="text" name="horaFinal" value="<?php echo $dados['horafinal'];?>">
    edite seu horario Final
    <input  type="date" value="<?php echo $dados['data'];?>" name="data"/><br><br>
    Edite sua data 
    <br><br>

    <input type="submit" value="Editar"/>

    <p> <button href="index.php">Voltar</button>

</form>
    
</body>
</html>