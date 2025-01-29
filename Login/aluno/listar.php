<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    
    <!-- CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
    <link href="../../Style/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../../Style/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Estilo para o link de certificado */
        a.certificado-link {
            color: #1976D2; /* Cor azul para o link */
            text-decoration: none; /* Remove o sublinhado */
            font-weight: bold; /* Deixa o texto em negrito */
            display: inline-flex;
            align-items: center;
            gap: 8px; /* Espaçamento entre o ícone e o texto */
        }

        /* Efeito de hover */
        a.certificado-link:hover {
            color: #1565C0; /* Cor mais escura ao passar o mouse */
        }

        a.certificado-link i {
            font-size: 20px; /* Tamanho do ícone */
        }

        /* Opções de estado (exemplo para projetos inativos) */
        .inactive-project {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container section scrollspy">
        <div class="section">
        <h3>Emitir certificado</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once("../../conecta.php");
                        $conexao = conectar();
                        $tipo_usuario = $_SESSION['usuario'][2]; // Tipo de usuário: 1 = Professor, 3 = Aluno
                        $id_usuario = mysqli_real_escape_string($conexao, $_SESSION['usuario'][1]);

                        if ($tipo_usuario == 3) {
                            // Query para o aluno
                            $sql = "SELECT projeto.*, usuario_projeto.* FROM projeto 
                                    JOIN usuario_projeto ON projeto.id_projeto = usuario_projeto.fk_projeto_id_projeto
                                    WHERE usuario_projeto.fk_usuario_id_usuario = '$id_usuario'
                                    ORDER BY projeto.situacao ASC";
                        } else {
                            die('Acesso negado.');
                        }

                        $resultado = mysqli_query($conexao, $sql);
                        $quantidade_linha = $resultado->num_rows;

                        if ($quantidade_linha == 0) {
                            echo "<tr><td colspan='2'>Você não tem projetos cadastrados!</td></tr>";
                        } else {
                            while ($dados = mysqli_fetch_assoc($resultado)) {
                                echo '<tr>';
                                echo '<td>' . $dados['nome_projeto'] . '</td>';
                                echo '<td>';

                                // Ações para o aluno
                                if ($tipo_usuario == 3) {
                                    $busca_sql_user_pro = "SELECT * FROM usuario_projeto user_pro 
                                        INNER JOIN projeto pro 
                                        ON pro.id_projeto = user_pro.fk_projeto_id_projeto
                                        WHERE user_pro.fk_usuario_id_usuario = $id_usuario";

                                    $resultado_busca_sql_user_pro = executarSQL($conexao, $busca_sql_user_pro);
                                    $quantidade_linhas = $resultado_busca_sql_user_pro->num_rows;
                                    $ja_inscrito = false;

                                    // Verifica se o aluno já está inscrito
                                    while ($usuario_projeto = mysqli_fetch_assoc($resultado_busca_sql_user_pro)) {
                                        if ($usuario_projeto['fk_projeto_id_projeto'] == $dados['id_projeto']) {
                                            $ja_inscrito = true;
                                            break;
                                        }
                                    }

                                    // Exibe sempre a opção de certificado com o ícone correto
                                    echo '<a href="certificado.php?id_projeto=' . $dados['id_projeto'] . '&verificacao='.$dados['id_inscricao'].'" class="certificado-link"><i class="material-icons">book</i>Certificado</a>';
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Estilos e Scripts -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="../Style/js/materialize.js"></script>
    <script src="../Style/js/init.js"></script>
    <script>
        // Você pode adicionar qualquer script adicional aqui
    </script>
</body>

</html>
