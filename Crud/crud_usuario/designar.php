<?php
//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

// Seleciona todos os dados da tabela historia
$sql = "SELECT id_usuario,nome,email,usuario_tipo FROM usuario";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);
echo '<h1>Designar Monitor</h1>';
//Lista os itens
echo '<table border=1>
<tr>
<th>nome</th>
<th>Email</th>
<th>Tipo usuario</th>
<th colspan=3>Opções</th>
</tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
echo '<tr>';    
echo '<td>'.$dados['nome'].'</td>';
echo '<td>'.$dados['email'].'</td>';
echo '<td>'.$dados['usuario_tipo'].'</td>';
echo '<td> <a href="formedit.php?id_usuario='.$dados['id_usuario'].'"> <img src="imagens/editar.png" width="20" height="20"> </a> </td>';
echo '<td> <a href="excluir?id_usuario='.$dados['id_usuario'].'"> <img src="imagens/excluir.png" width="20" height="20"> </a> </td>';
echo '</tr>';
}

echo '</table>'."<br>";
echo '<button><a href="../../login/professor/professor.php">Voltar</a></button>';
?>