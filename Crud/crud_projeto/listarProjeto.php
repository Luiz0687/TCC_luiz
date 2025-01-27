<?php
require_once("../../notificacao/funcaoNotificacao.php");

require_once("../../conecta.php");
$conexao = conectar();

// Verificar se a variável 'usuario' está definida
if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario'][1])) {
    die('Sessão de usuário não definida ou inválida.');
}

// Obter o ID do professor de forma segura
$id_professor = mysqli_real_escape_string($conexao, $_SESSION['usuario'][1]);

// Seleciona apenas os projetos com o status 'Ativo'
$sql = "SELECT * FROM projeto WHERE fk_projeto_id_professor = '$id_professor' AND situacao = 'Ativo' ORDER BY situacao ASC";

// Executa o Select
$resultado = mysqli_query($conexao, $sql);

$quantidade_linha = $resultado->num_rows;

if ($quantidade_linha == 0) {
    echo "Você não tem projetos ativos cadastrados!";
} else {
?>

    <table class="highlight">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($dados = mysqli_fetch_assoc($resultado)) {
                echo '<tr>';
                echo '<td>' . $dados['nome_projeto'] . '</td>';
                echo '<td>' . '<i class="material-icons left" style="color: #05CA5D;">brightness_1</i>' . $dados['situacao'] . '</td>';
                // Link para designar monitor ao projeto
                echo '<td> 
                        <a href="../../Crud/crud_usuario/designar.php?id_projeto=' . $dados['id_projeto'] . '" class="waves-effect waves-light btn-flat">
                            <i class="material-icons left">assignment_ind</i>Designar Monitor para este Projeto
                        </a>
                      </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

<?php
}
?>
