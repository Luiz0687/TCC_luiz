<?php
// Conectar ao banco de dados
require_once("../../notificacao/funcaoNotificacao.php");
require_once("../../conecta.php");
$conexao = conectar();
$id_projeto = $_GET['id_projeto'];

// Seleciona os dados agrupando por usuário e somando a carga horária, considerando a presença/ausência na tabela de frequência
$sql = "SELECT user.nome, 
               SUM(CASE 
                        WHEN freq.id_frequencia IS NOT NULL THEN en.CH 
                        ELSE 0 
                    END) AS total_CH
        FROM projeto pro 
        INNER JOIN encontro en ON en.fk_id_projeto = pro.id_projeto 
        INNER JOIN usuario_projeto userpro ON userpro.fk_projeto_id_projeto = pro.id_projeto 
        INNER JOIN usuario user ON user.id_usuario = userpro.fk_usuario_id_usuario 
        LEFT JOIN frequencia freq ON freq.fk_id_encontro = en.id_encontro 
                                   AND freq.fk_usuario_id_usuario = user.id_usuario
        WHERE pro.id_projeto = $id_projeto 
        GROUP BY user.id_usuario";

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
    echo '<td>' . $dados['nome'] . '</td>';
    echo '<td>' . $dados['total_CH'] . '</td>';
    echo '<td><button><a href="../../certificado.php?verificador=' . $id_inscricao .  '">Emitir Certificado</a></button></td>';
    echo '</tr>';
}

echo '<hr>';
echo '</table>' . "<br>";
?>
