<?php
//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

// Seleciona todos os dados da tabela historia
$sql = "SELECT * FROM projeto WHERE fk_projeto_id_professor =" . $_SESSION['usuario'][1];

// Executa o Select
$resultado = mysqli_query($conexao, $sql);

$quantidade_linha = $resultado->num_rows;

if ($quantidade_linha == 0) {

    echo "Você não tem projetos cadastrados!";
} else {

    //Lista os itens
    echo '<table border=1>
<tr>
</tr>';

    while ($dados = mysqli_fetch_assoc($resultado)) {
        if ($dados['situacao'] == "disponivel") {
            echo '<tr>';
            echo '<td>' . $dados['nome_projeto'] . '</td>';
            echo '<td>' . $dados['situacao'] . '</td>';
            echo '<td> <a href="../../Crud/crud_encontro/listar.php?id_projeto=' . $dados['id_projeto'] . '">encontros</a> </td>';
            echo '<td> <a href="../../Crud/crud_projeto/finalizar.php?id_projeto=' . $dados['id_projeto'] . '">finalizar</a></td>';
            echo '<td> <a href="../../Crud/crud_projeto/excluir.php?id_projeto=' . $dados['id_projeto'] . '">Excluir Projeto</a></td>';
            echo '</tr>';
        }else{
            echo '<tr>';
            echo '<td>' . $dados['nome_projeto'] . '</td>';
            echo '<td>' . $dados['situacao'] . '</td>';
            echo '<td> <a href="../../certificado.php?id_projeto=' . $dados['id_projeto'] . '"> Certificado </a></td>';
            echo '</tr>';
        }
    }
    echo '</table>' . "<br>";
}
