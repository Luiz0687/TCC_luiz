<?php
// Conectar ao banco de dados
require_once("../../notificacao/funcaoNotificacao.php");
require_once("../../conecta.php");
$conexao = conectar();
$id_projeto = $_GET['id_projeto'];

// Verifica se o id_projeto está definido e é numérico
if (!isset($id_projeto) || !is_numeric($id_projeto)) {
    die("ID do projeto inválido.");
}

// Corrige o SQL e adiciona alias para evitar ambiguidades
$sql = "SELECT 
            user.nome, 
            userpro.id_inscricao, 
            SUM(CASE WHEN freq.id_frequencia IS NOT NULL THEN en.CH ELSE 0 END) AS total_CH
        FROM 
            projeto pro
        INNER JOIN 
            encontro en ON en.fk_id_projeto = pro.id_projeto
        INNER JOIN 
            usuario_projeto userpro ON userpro.fk_projeto_id_projeto = pro.id_projeto
        INNER JOIN 
            usuario user ON user.id_usuario = userpro.fk_usuario_id_usuario
        LEFT JOIN 
            frequencia freq ON freq.fk_id_encontro = en.id_encontro
            AND freq.fk_usuario_id_usuario = user.id_usuario
        WHERE 
            pro.id_projeto = $id_projeto
        GROUP BY 
            user.id_usuario;";

// Executa o Select e verifica erros
$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    // Mostra o erro do MySQL
    die("Erro na consulta SQL: " . mysqli_error($conexao));
}

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
    echo '<td>' . ($dados['nome']) . '</td>';
    echo '<td>' . ($dados['total_CH']) . '</td>';
    echo '<td><button><a href="../../certificado.php?verificacao=' . ($dados['id_inscricao']) .'">Emitir Certificado</a></button></td>';
    echo '</tr>';
}

echo '</table>'; 
?>
