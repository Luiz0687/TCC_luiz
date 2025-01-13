<?php

// Conectar ao BD
require_once("../../conecta.php");
$conexao = conectar();

$id_encontro = $_GET['id_encontro'];

// Adicionar presença
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marcar_presenca'])) {
    $idAluno = $_POST['id_aluno'] ?? null;

    if (!empty($idAluno)) {
        // Verifica se o aluno já possui presença registrada
        $verificaPresenca = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM frequencia WHERE fk_id_encontro = $id_encontro AND fk_usuario_id_usuario = $idAluno");
        $resultadoPresenca = mysqli_fetch_assoc($verificaPresenca);

        if ($resultadoPresenca['total'] == 0) {
            // Adiciona a presença no banco de dados
            $sql = "INSERT INTO frequencia (fk_id_encontro, fk_usuario_id_usuario) VALUES ($id_encontro, $idAluno)";
            mysqli_query($conexao, $sql);
        } else {
            echo '<p style="color: red;">A presença deste aluno já foi registrada.</p>';
        }
    } else {
        echo '<p style="color: red;">Por favor, selecione um aluno.</p>';
    }
}

// Excluir presença
if (!empty($_GET['excluir'])) {
    $id_usuario = $_GET['id_usuario'];

    $sql = "DELETE FROM frequencia WHERE fk_usuario_id_usuario = $id_usuario AND fk_id_encontro = $id_encontro";
    mysqli_query($conexao, $sql);
}

// Receber os dados do encontro
$sqlEncontro = "SELECT * FROM encontro WHERE id_encontro = $id_encontro";
$resultadoEncontro = mysqli_query($conexao, $sqlEncontro);
$dadosEncontro = mysqli_fetch_assoc($resultadoEncontro);

// Buscar alunos que ainda não possuem presença registrada
$sqlAlunos = "SELECT usuario.id_usuario, usuario.nome 
              FROM usuario
              INNER JOIN usuario_projeto 
              ON usuario_projeto.fk_usuario_id_usuario = usuario.id_usuario
              WHERE usuario_projeto.fk_projeto_id_projeto = " . $dadosEncontro["fk_id_projeto"] . "
              AND usuario.id_usuario NOT IN (
                  SELECT fk_usuario_id_usuario 
                  FROM frequencia 
                  WHERE fk_id_encontro = $id_encontro
              )";

$resultadoAlunos = mysqli_query($conexao, $sqlAlunos);

echo '<h3> Marcar presença:</h3>';
if (mysqli_num_rows($resultadoAlunos) > 0) {
    while ($aluno = mysqli_fetch_assoc($resultadoAlunos)) {
        echo '<div>';
        echo '<span>' . htmlspecialchars($aluno['nome']) . '</span>';
        echo '<form method="POST" action="./chamada?id_encontro=' . $id_encontro . '" style="display: inline;">';
        echo '<input type="hidden" name="id_aluno" value="' . htmlspecialchars($aluno['id_usuario']) . '">';
        echo '<button type="submit" name="marcar_presenca">Adicionar</button>';
        echo '</form>';
        echo '</div>';
    }
} else {
    echo '<p>Todos os alunos já possuem presença registrada.</p>';
}

// Listar alunos com presença registrada
$sql = "SELECT usuario.id_usuario, usuario.nome 
        FROM usuario 
        INNER JOIN frequencia 
        ON frequencia.fk_usuario_id_usuario = usuario.id_usuario 
        WHERE fk_id_encontro = $id_encontro";

$resultado = mysqli_query($conexao, $sql);

echo '<h3>Alunos com presença registrada:</h3>';
while ($dados = mysqli_fetch_assoc($resultado)) {
    echo '<div>';
    echo '<span>' . htmlspecialchars($dados['nome']) . '</span>';
    echo '<a href="./chamada?id_usuario=' . $dados['id_usuario'] . '&excluir=1&id_encontro=' . $id_encontro . '" style="margin-left: 10px;">';
    echo '<button type="button">Remover</button>';
    echo '</a>';
    echo '</div>';
}

echo '<br><button><a href="../crud_encontro/listar.php?id_projeto=' . $dadosEncontro['fk_id_projeto'] . '">Voltar</a></button>';
?>
