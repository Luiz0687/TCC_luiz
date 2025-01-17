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
    
    <link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
    <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
    <link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">
</head>

<body>

    <?php


    $id_encontro = $_GET['id_encontro'];

    $sql = "SELECT usuario.id_usuario, usuario.nome, horario.hora, encontro.nome_encontro FROM encontro
    inner join projeto on  projeto.id_projeto = encontro.fk_id_projeto
    inner join usuario_projeto on usuario_projeto.fk_projeto_id_projeto = projeto.id_projeto
    inner join usuario on usuario.id_usuario = usuario_projeto.fk_usuario_id_usuario
    inner join horario on horario.fk_projeto_id_projeto = projeto.id_projeto
    where id_encontro = " . $id_encontro;

    // Executa o Select
    $resultado = mysqli_query($conexao, $sql);

    $dados = mysqli_fetch_assoc($resultado);

    ?>

    <h1>Cadastro de Frequência</h1>

    <p>Projeto <?= $dados['nome_encontro'] ?> </p>
    <p>Horario do projeto <b><?= $dados['hora'] ?></b> </p>

    <?php

    mysqli_data_seek($resultado, 0);
    ?>
    <form action="cadastrar.php" method="post">


        <label>Estudantes</label><br>
        <select name="id_usuario">
            <?php
            while ($dados = mysqli_fetch_assoc($resultado)) {
                echo "<option value='" . $dados['id_usuario'] . "'> " . $dados['nome'] . " </option>";
            }
            ?>
        </select><br><br>


        <label>Situação</label>
        <select name="situacao">
            <option value="presente">Presente</option>
            <option value="ausente">Ausente</option>
        </select>

        <br><br>

        <input type="submit" value="cadastrar"><br><br>

        <button><a href="../crud_encontro/listar.php">Voltar</a></button>
    </form>
</body>

</html>