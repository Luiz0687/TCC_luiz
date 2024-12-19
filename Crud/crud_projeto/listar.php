<?php
//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

// Seleciona todos os dados da tabela historia
$sql = "SELECT * FROM projeto";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);


//Lista os itens
echo '<table border=1>
<tr>
</tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
echo '<tr>';    

echo '<td>'.$dados['nome_projeto'].'</td>';
echo '<td>'.$dados['situacao'].'</td>';
echo '<td> <a href="../../Crud/crud_encontro/listar.php?id_projeto='.$dados['id_projeto'].'">encontros</a> </td>';
echo '<td> <a href="../sair.php">finalizar</a></td>';
echo '<td> <a href="../../Crud/crud_projeto/excluir.php?id_projeto='.$dados['id_projeto'].'">Excluir Projeto</a></td>';
echo '</tr>';
}

echo '</table>'."<br>";

?>