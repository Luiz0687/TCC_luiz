<?php
//conectar ao banco de dados.
require_once("../../conecta.php");

// Seleciona todos os dados da tabela historia
$sql = "SELECT * FROM horario";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);

$semanas = [ "", "Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"  ];




//Lista os itens
echo '<table border=1>
<tr>
<th>Id horario</th>
<th>semana</th>
<th>hora</th>
<th colspan=3>Opções</th>
</tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
echo '<tr>';    
echo '<td>'.$dados['id_horario'] . '</td>';
echo '<td>'.$semanas[$dados['cod_semana']] . '</td>';
echo '<td>'.$dados['hora'].'</td>';
echo '<td> <a href="formedit.php?id_horario='.$dados['id_horario'].'"> <img src="imagens/editar.png" width="20" height="20"> </a> </td>';
echo '<td> <a href="excluir?id_horario='.$dados['id_horario'].'"> <img src="imagens/excluir.png" width="20" height="20"> </a> </td>';
echo '</tr>';
}

echo '</table>'."<br>";
echo '<button><a href="index.php">Voltar</a></button>';
?>