<?php
//conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

$id_projeto = $_GET['id_projeto'];

echo '<link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
<link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
<link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">';
// Seleciona todos os dados da tabela historia
$sql = "SELECT pro.nome_projeto, pro.situacao, en.horario, en.data, en.id_encontro FROM projeto pro 
INNER JOIN encontro en 
ON pro.id_projeto = en.fk_id_projeto
WHERE pro.id_projeto = $id_projeto";

// Executa o Select
$resultado = mysqli_query($conexao,$sql);

$quantidade_linha = $resultado->num_rows;

if ($quantidade_linha == 0) {
    
}else {
    
    
}

$lstDados = [];

while ($dados = mysqli_fetch_assoc($resultado)) {
    $lstDados [] = $dados;
}



if (count($lstDados) == 0) {
    echo '<h2>Este projeto não possui encontros</h2>';
} else {
    echo '<h2>' . $lstDados[0]['nome_projeto'] . '</h2>';
}


//Lista os itens
echo '<table border=1>
<tr>

<th>Data</th>
<th>Horario</th>
<th>situação</th>
<th colspan=3>Ações</th>
</tr>';

//while ($dados = mysqli_fetch_assoc($resultado)) {

    foreach ($lstDados as $dados) { 
        echo '<tr>';    

        echo '<td>'.$dados['data'].'</td>';
        echo '<td>'.$dados['horario'].'</td>';
        echo '<td>'.$dados['situacao'].'</td>';


        echo '<td> <a href="../crud_frequencia/chamada.php?id_encontro=' .  $dados['id_encontro']  .  '"> Frequência</a> </td>';

        echo '<td> <a href="excluir?id_encontro='.$dados['id_encontro'].'"><img src="imagens/excluir.png" width="20" height="20"></a> </td>';
        echo '</tr>';
    }    
        echo '</table>'."<br>";
        echo '<a href="../../Crud/crud_encontro/formcad.php?id_projeto='.$id_projeto.'">Inserir encontro</a>' . "<br><br>";

        echo '<button><a href="../../login/professor/professor.php">Voltar</a></button>';
   ?>