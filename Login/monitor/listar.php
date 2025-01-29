    <?php
    require_once("../../notificacao/funcaoNotificacao.php");
    require_once("../../conecta.php");
    $conexao = conectar();

    // Verificar se a variável 'usuario' está definida
    if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario'][1]) || !isset($_SESSION['usuario'][2])) {
        die('Sessão de usuário não definida ou inválida.');
    }

    // Obter o ID do usuário e o tipo de usuário (1 = professor, 2 = monitor)
    $id_usuario = mysqli_real_escape_string($conexao, $_SESSION['usuario'][1]);
    $tipo_usuario = mysqli_real_escape_string($conexao, $_SESSION['usuario'][2]);

    // Lógica para exibir os projetos conforme o tipo de usuário
    if ($tipo_usuario == 1) { // Caso seja professor
        // Selecionar os projetos ATIVOS do professor logado
        $sql = "
            SELECT id_projeto, nome_projeto, situacao
            FROM projeto
            WHERE fk_projeto_id_professor = '$id_usuario'
            AND situacao = 'Ativo'
            ORDER BY situacao ASC
        ";
    } elseif ($tipo_usuario == 2) { // Caso seja monitor
        // Selecionar todos os projetos ATIVOS vinculados aos professores
        $sql = "
            SELECT p.id_projeto, p.nome_projeto, p.situacao
            FROM projeto p
            INNER JOIN usuario u ON u.id_usuario = p.fk_projeto_id_professor
            WHERE u.usuario_tipo = 1
            AND p.situacao = 'Ativo'
            ORDER BY p.situacao ASC
        ";
    } else {
        die('Você não tem permissão para visualizar projetos.');
    }

    // Executar a consulta SQL
    $resultado = mysqli_query($conexao, $sql);

    // Verificar se a consulta foi executada corretamente
    if (!$resultado) {
        die('Erro na consulta SQL: ' . mysqli_error($conexao)); // Exibe o erro de consulta
    }

    $quantidade_linha = $resultado->num_rows;

    // Exibir os projetos ou mensagem de ausência
    if ($quantidade_linha == 0) {
        echo "Nenhum projeto ativo encontrado!";
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
                    echo '<td>' . htmlspecialchars($dados['nome_projeto']) . '</td>';
                    echo '<td><i class="material-icons left" style="color: #05CA5D;">brightness_1</i>' . htmlspecialchars($dados['situacao']) . '</td>';
                    echo '<td><a href="listarEncontro?id_projeto=' . htmlspecialchars($dados['id_projeto']) . '" class="waves-effect waves-light btn-flat"><i class="material-icons left">people</i>Encontros</a></td>';
                    echo '</tr>';
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