<?php
require_once("../../conecta.php");
$conexao = conectar();

//buscar pelos projetos
$sql = "SELECT * FROM projeto";
$query = mysqli_query($conexao, $sql);

//buscar pelos dias da semana
$sql2 = "SELECT * FROM horario";
$query2 = mysqli_query($conexao, $sql2);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de horario</title>
</head>

<body>
    <form action="cadastrar.php" method="post">


       

        <label>Projeto</label>
        <select name="fk_projeto_id_projeto">
            <option disabled selected>Escolha o projeto</option>
            <?php
            while ($dados = mysqli_fetch_assoc($query)) {

            ?>
                <option value="<?php echo $dados['id_projeto'];?>"><?php echo $dados['nome_projeto'];?></option>
            <?php
            }
            ?>
        </select>
        <br><br>

        <lablel>Dia da semana</lablel>
        <select name="cod_semana">
            <option value="1">Domingo</option>
            <option value="2">Segunda-feira</option>
            <option value="3">Terça-feira</option>
            <option value="4">Quarta-feira</option>
            <option value="5">Quinta-feira</option>
            <option value="6">Sexta-feira</option>
            <option value="7">Sábado</option>
        </select>


        <br><br>
        Informe o horario do projeto : <input type="time" name="hora" required><br><br>
        <input type="submit" value="cadastrar"><br>
        <button><a href="index.php">Voltar</a></button>
    </form>
</body>

</html>