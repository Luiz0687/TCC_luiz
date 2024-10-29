<?php
//conectar ao banco de dados.
require_once("../../conecta.php");

// Seleciona todos os dados da tabela historia
$sql = "SELECT * FROM projeto";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);


//Lista os itens
echo '<table border=1>
<tr>
<th>Projetos disponiveis</th>
</tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
echo '<tr>';    
echo '<td>'.$dados['nome_projeto'].'</td>';
echo '</tr>';
}

echo '</table>'."<br>";
echo '<button><a href="aluno.php">Voltar</a></button>';
