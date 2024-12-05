<?php
//conectar ao banco de dados.
require_once("../conecta.php");

// Seleciona todos os dados da tabela historia
$sql = "SELECT * FROM projeto";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);


//Lista os itens
echo '<table border=1>
<tr>
<th>Id projeto</th>
<th>nome</th>
<th colspan=3>Opções</th>
</tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
echo '<tr>';    
echo '<td>'.$dados['id_projeto'].'</td>';
echo '<td>'.$dados['nome_projeto'].'</td>';
echo '<td> <a href="formedit.php?id_projeto='.$dados['id_projeto'].'"> <img src="imagens/editar.png" width="20" height="20"> </a> </td>';
echo '<td> <a href="excluir?id_projeto='.$dados['id_projeto'].'"> <img src="imagens/excluir.png" width="20" height="20"> </a> </td>';
echo '</tr>';
}

echo '</table>'."<br>";
echo '<button><a href="index.php">Voltar</a></button>';
?>