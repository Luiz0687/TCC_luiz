<?php
//conectar ao banco de dados.
require_once("../../conecta.php");

// Seleciona todos os dados da tabela historia
$sql = "SELECT * FROM encontro";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);


//Lista os itens
echo '<table border=1>
<tr>
<th>Id encontro</th>
<th>nome</th>
<th>descricao</th>
<th>data</th>
<th>horario</th>
<th colspan=3>Opções</th>
</tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
echo '<tr>';    
echo '<td>'.$dados['id_encontro'].'</td>';
echo '<td>'.$dados['nome'].'</td>';
echo '<td>'.$dados['descricao'].'</td>';
echo '<td>'.$dados['data_'].'</td>';
echo '<td>'.$dados['horario'].'</td>';
echo '<td> <a href="formedit.php?id_encontro='.$dados['id_encontro'].'"> <img src="imagens/editar.png" width="20" height="20"> </a> </td>';
echo '<td> <a href="excluir?id_encontro='.$dados['id_encontro'].'"> <img src="imagens/excluir.png" width="20" height="20"> </a> </td>';
echo '</tr>';
}

echo '</table>'."<br>";
echo '<button><a href="index.php">Voltar</a></button>';
?>