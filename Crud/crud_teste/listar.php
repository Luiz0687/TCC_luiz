<?php
//conectar ao banco de dados.
require_once("../conecta.php");

// Seleciona todos os dados da tabela historia
$sql = "SELECT * FROM usuario";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);


//Lista os itens
echo '<table border=1>
<tr>
<th>Id Usuario</th>
<th>nome</th>
<th>Email</th>
<th>Senha</th>
<th>tipo usuario</th>
<th colspan=3>Opções</th>
</tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
echo '<tr>';    
echo '<td>'.$dados['id_usuario'].'</td>';
echo '<td>'.$dados['nome'].'</td>';
echo '<td>'.$dados['email'].'</td>';
echo '<td>'.$dados['senha'] .'</td>';
echo '<td>'.$dados['usuario_tipo'].'</td>';
echo '<td> <a href="formedit.php?id_usuario='.$dados['id_usuario'].'"> <img src="imagens/editar.png" width="20" height="20"> </a> </td>';
echo '<td> <a href="excluir?id_usuario='.$dados['id_usuario'].'"> <img src="imagens/excluir.png" width="20" height="20"> </a> </td>';
echo '</tr>';
}

echo '</table>'."<br>";
echo '<button><a href="index.php">Voltar</a></button>';
?>