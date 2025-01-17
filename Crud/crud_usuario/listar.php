<?php
// Conectar ao banco de dados
require_once("../../notificacao/funcaoNotificacao.php");
require_once("../../conecta.php");
$conexao = conectar();

// Seleciona os dados agrupando por usuário
$sql = "SELECT 
            usuario.id_usuario, 
            usuario.nome AS nome_usuario, 
            SUM(encontro.CH) AS CH
        FROM projeto projeto
        INNER JOIN usuario_projeto user_pro
            ON user_pro.fk_projeto_id_projeto = projeto.id_projeto
        INNER JOIN usuario usuario
            ON usuario.id_usuario = user_pro.fk_usuario_id_usuario
        INNER JOIN encontro encontro
            ON encontro.fk_id_projeto = projeto.id_projeto
        WHERE projeto.fk_projeto_id_professor = " . $_SESSION['usuario'][1] . "
        GROUP BY usuario.id_usuario, usuario.nome";

// Executa o Select
$resultado = mysqli_query($conexao, $sql);

// Lista os itens
echo '<table border=1>
<tr>
<th>Nome</th>
<th>Carga Horária Total</th>
<th>Opções</th>
</tr>';

// Exibe os dados
while ($dados = mysqli_fetch_assoc($resultado)) {
    echo '<tr>';    
    echo '<td>' . $dados['nome_usuario'] . '</td>';
    echo '<td>' . $dados['CH'] . '</td>';
    echo '<td><button><a href="../../certificado.php?id_usuario=' . $dados['id_usuario'] . '">Emitir Certificado</a></button></td>';
    echo '</tr>';
}

echo '</table>' . "<br>";
echo '<button><a href="../../Crud/crud_encontro/listar.php">Voltar</a></button>';
?>
