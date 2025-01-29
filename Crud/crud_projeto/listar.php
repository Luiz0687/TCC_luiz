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

// Seleciona todos os dados da tabela 'projeto'
$sql = "SELECT * FROM projeto WHERE fk_projeto_id_professor = '$id_professor' ORDER BY situacao ASC";

// Executa o Select
$resultado = mysqli_query($conexao, $sql);

$quantidade_linha = $resultado->num_rows;

if ($quantidade_linha == 0) {
    echo "Você não tem projetos cadastrados!";
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
                if ($dados['situacao'] == "Ativo") {
                    echo '<tr>';
                    echo '<td>' . $dados['nome_projeto'] . '</td>';
                    echo '<td><i class="material-icons left" style="color: #05CA5D;">brightness_1</i>' . $dados['situacao'] . '</td>';
                    echo '<td><a href="../../Crud/crud_encontro/listar.php?id_projeto=' . $dados['id_projeto'] . '" class="waves-effect waves-light btn-flat"><i class="material-icons left">people</i>Encontros</a></td>';
                    echo '<td><a href="../../Crud/crud_projeto/finalizar.php?id_projeto=' . $dados['id_projeto'] . '" class="waves-effect waves-light btn-flat"><i class="material-icons left">flag</i>Finalizar</a></td>';
                    echo '<td><a href="../../Crud/crud_usuario/designar.php?id_projeto=' . $dados['id_projeto'] . '" class="waves-effect waves-light btn-flat"><i class="material-icons left">person</i>Monitor</a></td>';
                    echo '<td><a href="#" data-href="../../Crud/crud_projeto/excluir.php?id_projeto=' . $dados['id_projeto'] . '" class="btn-delete waves-effect waves-light btn-flat"><i class="material-icons">delete</i></a></td>';
                    echo '</tr>';
                } else {
                    echo '<tr>';
                    echo '<td>' . $dados['nome_projeto'] . '</td>';
                    echo '<td><i class="material-icons left" style="color: #F20F10;">brightness_1</i>' . $dados['situacao'] . '</td>';
                    echo '<td><a href="../../Login/professor/certificadoAluno.php?id_projeto=' . $dados['id_projeto'] . '" class="waves-effect waves-light btn-flat"><i class="material-icons left">book</i>Certificados</a></td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>

<?php
}
?>

<!-- Estilos e Scripts -->
<style>
    a.waves-effect {
        margin: 0 5px;
    }
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../../Style/js/materialize.js"></script>
<script src="../../Style/js/init.js"></script>
<script>
    // Evento para adicionar confirmação no botão de excluir
    $(document).ready(function () {
        // Inicializar componentes do Materialize
        $('.materialboxed').materialbox();
        $('.button-collapse').sideNav();

        // Adicionar evento de confirmação ao clicar no botão de excluir
        $('.btn-delete').on('click', function (e) {
            e.preventDefault(); // Impedir o comportamento padrão do link
            var href = $(this).data('href'); // Obter a URL do atributo data-href
            var confirmacao = confirm('Tem certeza de que deseja excluir este projeto? Esta ação não pode ser desfeita.');

            if (confirmacao) {
                window.location.href = href; // Redirecionar para a URL de exclusão
            }
        });
    });
</script>
