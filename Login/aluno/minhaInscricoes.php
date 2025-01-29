<?php
require_once "../../conecta.php";
$conexao = conectar();

include_once("../../notificacao/funcaoNotificacao.php");

// Obter os projetos nos quais o usuário está inscrito
$sql = "SELECT 
            pro.id_projeto, 
            pro.nome_projeto 
        FROM usuario_projeto 
        INNER JOIN projeto pro ON pro.id_projeto = fk_projeto_id_projeto 
        WHERE fk_usuario_id_usuario = " . $_SESSION['usuario'][1];
$resultado = executarSQL($conexao, $sql);
$projetos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

// Processar saída do projeto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_projeto'])) {
    $id_projeto = $_POST['id_projeto'];
    $sql_remover = "DELETE FROM usuario_projeto 
                    WHERE fk_projeto_id_projeto = $id_projeto 
                      AND fk_usuario_id_usuario = " . $_SESSION['usuario'][1];
    if (executarSQL($conexao, $sql_remover)) {
        echo "<script>alert('Você saiu do projeto com sucesso!');</script>";
        header("Refresh:0"); // Recarrega a página para atualizar a lista
    } else {
        echo "<script>alert('Erro ao tentar sair do projeto.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Minhas Inscrições nos Projetos</title>

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
    </style>

    <script>
        function confirmarSaida(idProjeto) {
            if (confirm("Tem certeza que deseja sair deste projeto?")) {
                document.getElementById("form-sair-" + idProjeto).submit();
            }
        }
    </script>
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
                <li><a href="aluno.php" > Projetos</a></li>
                    <li><a href="minhaInscricoes.php">Inscrições</a></li>
                    <li><a href="inicioCertificado.php">Certificado</a></li>
                    <li><a href="../../index.php">Sair</a></li>

                </ul>
                <ul class="right side-nav" id="mobile-demo">
                <li><a href="" > Projetos</a></li>
                    <li><a href="minhaInscricoes.php">Inscrições</a></li>
                    <li><a href="inicioCertificado.php">Certificado</a></li>
                    <li><a href="../../index.php">Sair</a></li>
                </ul>
            </div>
        </nav>
    </div>

    
         

    <div class="container section scrollspy">
        <div class="section">
            <h3>Minhas Inscrições</h3>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Projeto</th>
                        <th>Frequência</th>
                        <th>Opções</th>
                    </tr>
                    <?php
                    if (empty($projetos)) {
                        echo "<tr><td colspan='3'>Você não está inscrito em nenhum projeto.</td></tr>";
                    } else {
                        foreach ($projetos as $projeto) {
                            echo "<tr>";
                            echo "<td>" . $projeto['nome_projeto'] . "</td>";
                            echo '<td>
                                    <a href="frequencia.php?id_projeto=' . $projeto['id_projeto'] . '" class="blue-text">Ver Frequência</a>
                                  </td>';
                            echo '<td>
                                <form id="form-sair-' . $projeto['id_projeto'] . '" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_projeto" value="' . $projeto['id_projeto'] . '">
                                    <a href="#" onclick="confirmarSaida(' . $projeto['id_projeto'] . ')" class="red-text">
                                        Quero sair
                                    </a>
                                </form>
                            </td>';
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
