<?php
require_once "../../conecta.php";
$conexao = conectar();
include_once("../../notificacao/funcaoNotificacao.php");
$sql = "select * from usuario_projeto 
inner join projeto on id_projeto = fk_projeto_id_projeto 
inner join usuario on id_usuario = fk_usuario_id_usuario
where fk_usuario_id_usuario = " . $_SESSION['usuario'][1];
$resultado = executarSQL($conexao,$sql);

 
//Lista os itens
echo '<table border=1>
<tr>
<th>Suas incrições</th>

</tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
echo '<tr>';    
echo '<td>'.$dados['nome_projeto'].'</td>';
echo '</tr>';
}
echo '</table>'."<br>";

echo '<button><a href="aluno.php">Voltar</a></button>';




?>