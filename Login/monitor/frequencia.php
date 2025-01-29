<?php
// Conectar ao BD
require_once("../../conecta.php");
require_once "../../notificacao/funcaoNotificacao.php";
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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Projeto</title>

    <!-- CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
    <link href="../../Style/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../../Style/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .frequencia-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0;
        }

        .frequencia-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 600px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #f9f9f9;
            clear: both;  /* Garante que cada item fique em uma linha separada */
        }

        .frequencia-item button {
            background-color: black;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }

        .frequencia-item button:hover {
            background-color: gainsboro;
            color: black;
        }

        .frequencia-excluir button:hover {
            background-color: brown;
            color: white;
        }

        .frequencia-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .frequencia-item a {
            text-decoration: none;
            color: red;
        }

        .frequencia-item a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
<div id="navbar" class="navbar-fixed scrollspy">
        <nav class="white">
        <div class="container">
                    <a class="brand-logo"><img src="../../Style/images/logo.svg" style="height: 50px;"></a>
                </div>
            <div class="nav-wrapper container">
              

                <a href="" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="listarEncontro.php?id_projeto=<?php echo $dadosEncontro['fk_id_projeto'];?>">Voltar</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container section scrollspy">
        <div class="section">
            <div class="row">
                <div class="col s9">
                </div>
                <div class="col s3">
                </div>
            </div>

            <div class="frequencia-container">
                <h3 class="frequencia-title">Marcar presença:</h3>
                <?php
                if (mysqli_num_rows($resultadoAlunos) > 0) {
                    while ($aluno = mysqli_fetch_assoc($resultadoAlunos)) {
                        echo '<div class="frequencia-item">';
                        echo '<span>' . htmlspecialchars($aluno['nome']) . '</span>';
                        echo '<form method="POST" action="./frequencia?id_encontro=' . $id_encontro . '" style="display: inline;">';
                        echo '<input type="hidden" name="id_aluno" value="' . htmlspecialchars($aluno['id_usuario']) . '">';
                        echo '<button type="submit" name="marcar_presenca">Adicionar</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Não há mais alunos!</p>';
                }
                ?>

                <h3 class="frequencia-title">Alunos com presença:</h3>
                <?php
                // Listar alunos com presença registrada
                $sql = "SELECT usuario.id_usuario, usuario.nome 
                        FROM usuario 
                        INNER JOIN frequencia 
                        ON frequencia.fk_usuario_id_usuario = usuario.id_usuario 
                        WHERE fk_id_encontro = $id_encontro";

                $resultado = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($resultado) > 0) {
                    while ($dados = mysqli_fetch_assoc($resultado)) {
                        echo '<div class="frequencia-item">';
                        echo '<span>' . htmlspecialchars($dados['nome']) . '</span>';
                        echo '<div class="frequencia-excluir">';
                        echo '<a href="frequencia?id_usuario=' . $dados['id_usuario'] . '&excluir=1&id_encontro=' . $id_encontro . '">';
                        echo '<button type="button">Remover</button>';
                        echo '</a>';
                        echo '</div>';
                        echo '</div>'; // Fechar o item de presença
                    }
                } else {
                    echo '<p>Não há alunos com presença registrada.</p>';
                }
                ?>

            </div>

            <!-- Scripts -->
            <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
            <script src="../../Style/js/materialize.js"></script>
            <script src="../../Style/js/init.js"></script>
            <script>
                $(document).ready(function() {
                    $('.materialboxed').materialbox();
                    $('.button-collapse').sideNav();
                });
            </script>
</body>

</html>
