<?php
//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

// Seleciona todos os dados da tabela historia
$sql = "SELECT * FROM projeto WHERE fk_projeto_id_professor =" .  $_SESSION['usuario'][1]." ORDER BY situacao ASC";

// Executa o Select
$resultado = mysqli_query($conexao, $sql);

$quantidade_linha = $resultado->num_rows;

if ($quantidade_linha == 0) {

    echo "Você não tem projetos cadastrados!";
} else {

?>

    <table class="highlight">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>


        <tbody>

            <?php

            while ($dados = mysqli_fetch_assoc($resultado)) {
                if ($dados['situacao'] == "Ativo") {
                    echo '<tr>';
                    echo '<td>' . $dados['nome_projeto'] . '</td>';
                    echo '<td>' . '<i class="material-icons left" style="color: #05CA5D;">brightness_1</i>' . $dados['situacao'] . '</td>';
                    echo '<td> <a href="../../Crud/crud_encontro/listar.php?id_projeto=' . $dados['id_projeto'] . '" class="waves-effect waves-light  btn-flat"><i class="material-icons left">people</i>Encontros</a></a> </td>';
                    echo '<td> <a href="../../Crud/crud_projeto/finalizar.php?id_projeto=' . $dados['id_projeto'] . '" class="waves-effect waves-light  btn-flat"><i class="material-icons left">flag</i>Finalizar</a></a></td>';
                    echo '<td>  <a href="../../Crud/crud_projeto/excluir.php?id_projeto=' . $dados['id_projeto'] . '" class="waves-effect waves-light  btn-flat"><i class="material-icons">delete</i></a></td>';
                    echo '</tr>';
                } else {
                    echo '<tr>';
                    echo '<td>' . $dados['nome_projeto'] . '</td>';
                    echo '<td>' . '<i class="material-icons left" style="color: #F20F10;">brightness_1</i>' . $dados['situacao'] . '</td>';
                    echo '<td> <a href="../../certificado.php?id_projeto=' . $dados['id_projeto'] . '" class="waves-effect waves-light  btn-flat"><i class="material-icons left">book</i>Certificados</a></td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>


    </table>

<?php

}
