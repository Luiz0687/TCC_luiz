<?php
require_once("../../conecta.php");
$conexao = conectar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de projeto</title>
</head>
<body>

<?php


$id_encontro = $_GET['id_encontro'] ;

$sql2 = " select projeto.nome_projeto from projeto 
  inner join encontro on  projeto.id_projeto = encontro.fk_id_projeto
  where encontro.id_encontro = " . $id_encontro;


$sql = "SELECT usuario.id_usuario, usuario.nome FROM encontro
inner join projeto on  projeto.id_projeto = encontro.fk_id_projeto
inner join usuario_projeto on usuario_projeto.fk_projeto_id_projeto = projeto.id_projeto
inner join usuario on usuario.id_usuario = usuario_projeto.fk_usuario_id_usuario
where id_encontro = " . $id_encontro;


// Executa o Select
$resultadoNomeProjeto = mysqli_query($conexao,$sql2);
$dados  =   mysqli_fetch_assoc($resultadoNomeProjeto);
  
  ?>



    <h1>Cadastro de Frequência</h1>
    
    <form action="cadastrar.php" method="post">
    <label>Projeto  <?= $dados['nome_projeto'] ?> </label>

    <?php  
$resultado = mysqli_query($conexao,$sql);
?><br><br>

<label>Estudante</label><br><br>
    <select name="id_usuario">
        <?php
        while ($dados = mysqli_fetch_assoc($resultado)) {
            echo "<option value='" . $dados['id_usuario'] . "'> " . $dados['nome'] . " </option>";
        }
        ?>
    </select><br><br>

    Data : <input type="date" name="data"required><br><br>



    <label>Situação</label>
    <select name="situacao" >
       <option value="presente">Presente</option>
        <option value="ausente">Ausente</option>
    </select>

    <br><br>

    <input type="submit" value="cadastrar"><br><br>

        <button><a href="index.php">Voltar</a></button>
    </form>
</body>
</html>