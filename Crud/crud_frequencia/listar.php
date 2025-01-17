<?php
//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

echo '<link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
<link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
<link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">';

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