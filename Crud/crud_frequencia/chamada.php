<?php

// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();

$id_encontro = $_GET['id_encontro'];

// adicionar chamada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
    $idAluno = $_POST['aluno'] ?? null;

    if (!empty($idAluno)) {
        // Aqui você pode adicionar a lógica para o processamento
        //comando sql.
        $sql = "INSERT INTO frequencia (fk_id_encontro, fk_usuario_id_usuario) VALUES ($id_encontro ,   $idAluno)";

    
        mysqli_query($conexao, $sql);


    } else {
        echo 'Por favor, selecione um aluno.';
    }
}



//excluir chamada

if (!empty($_GET['excluir'])) {
    $id_usuario = $_GET['id_usuario'];

    $sql = "delete from frequencia where fk_usuario_id_usuario  = " .  $id_usuario  . " and fk_id_encontro = " . $id_encontro;

    mysqli_query($conexao, $sql);



}


// receber os dados do formulário
$sqlEncontro = "select * from encontro where id_encontro = " . $id_encontro;
$resultadoEncontro =  mysqli_query($conexao, $sqlEncontro);




// Gera o vetor com os dados buscados
$dadosEncontro = mysqli_fetch_assoc($resultadoEncontro );

$sqlAlunos = "select * from usuario inner join usuario_projeto on usuario_projeto.fk_usuario_id_usuario = usuario.id_usuario  "  . 
                    "where usuario_projeto.fk_projeto_id_projeto = " . $dadosEncontro["fk_id_projeto"];

$resultadoAlunos = mysqli_query($conexao, $sqlAlunos);


// Supondo que $resultadoAlunos é o resultado da consulta no banco
// Inicialize um array para armazenar os dados
$dadosAlunos = [];
while ($row = mysqli_fetch_assoc($resultadoAlunos)) {
    $dadosAlunos[] = $row; // Armazena cada linha em $dadosAlunos
}



// Verifica se há registros para exibir no dropdown
if (!empty($dadosAlunos)) {
    // Inicia o formulário
    echo '<form method="POST" action="./chamada?id_encontro=' . $id_encontro  .  '">';

    echo '<label for="aluno">Selecione um aluno:</label>';
    echo '<select name="aluno" id="aluno">';
    echo '<option value="">Selecione um aluno</option>'; // Primeira opção vazia
    foreach ($dadosAlunos as $aluno) {
        // Usando o id_usuario como valor e nome como rótulo
        echo '<option value="' . htmlspecialchars($aluno['id_usuario']) . '">'
             . htmlspecialchars($aluno['nome']) . '</option>';
    }
    echo '</select>';
    // Botão de adicionar
    echo '<button type="submit" name="adicionar">Adicionar</button>';
    echo '</form>';
} else {
    echo 'Nenhum aluno encontrado.';
}






//listar alunos com freqauencia
$sql = "SELECT * FROM  usuario inner join frequencia on frequencia.fk_usuario_id_usuario = usuario.id_usuario where fk_id_encontro = " . $id_encontro;

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
echo '<td>'.$dados['id_usuario'].'</td>';
echo '<td>'.$dados['nome'].'</td>';
echo '<td> <a href="./chamada?id_usuario=' . $dados['id_usuario'] .'&excluir=1&id_encontro=' . $id_encontro  . '"> <img src="imagens/excluir.png" width="20" height="20"> </a> </td>';
echo '</tr>';
}

echo '</table>'."<br>";
echo '<button><a href="../crud_encontro/listar.php?id_projeto='.$dadosEncontro['fk_id_projeto'].'">Voltar</a></button>';
?>


