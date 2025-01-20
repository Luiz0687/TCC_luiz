<?php
// Conectar ao banco de dados.
require_once("../../notificacao/funcaoNotificacao.php");
require_once("../../conecta.php");
$conexao = conectar();

// Verifica se o aluno já está inscrito em algum projeto
$busca_sql_user_pro = "SELECT * FROM usuario_projeto user_pro 
    INNER JOIN projeto pro 
    ON pro.id_projeto = user_pro.fk_projeto_id_projeto
    WHERE user_pro.fk_usuario_id_usuario = " . $_SESSION['usuario'][1];

$resultado_busca_sql_user_pro = executarSQL($conexao, $busca_sql_user_pro);
$quantidade_linhas = $resultado_busca_sql_user_pro->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Projetos Disponíveis</title>

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
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .inactive-project {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="navbar" class="navbar-fixed scrollspy">
        <nav class="white">
            <div class="nav-wrapper container">
                <a class="brand-logo"><img src="../../Style/images/logo.svg" style="height: 50px;"></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="../../Login/aluno/aluno.php">Voltar</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container section scrollspy">
        <div class="section">
            <h3>Projetos Disponíveis</h3>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Projetos Disponíveis</th>
                        <th>Opções</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM projeto";
                    $resultado = mysqli_query($conexao, $sql);
                    $projetos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                    foreach ($projetos as $projeto) {
                        $ja_inscrito = false;
                        foreach ($resultado_busca_sql_user_pro as $usuario_projeto) {
                            if ($usuario_projeto['fk_projeto_id_projeto'] == $projeto['id_projeto']) {
                                $ja_inscrito = true;
                                break;
                            }
                        }
                        echo '<tr>';
                        if ($projeto['situacao'] == "Inativo") {
                            echo '<td class="inactive-project">' . $projeto['nome_projeto'] . '</td>';
                            echo '<td class="inactive-project">Projeto Inativo</td>';
                        } else {
                            echo '<td>' . $projeto['nome_projeto'] . '</td>';
                            if ($ja_inscrito) {
                                echo '<td>Já Inscrito no Projeto</td>';
                            } else {
                                echo '<td><a href="inscricoes.php?id_projeto=' . $projeto['id_projeto'] . '">Inscrever-se</a></td>';
                            }
                        }
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
