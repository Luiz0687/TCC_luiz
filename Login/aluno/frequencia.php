<?php
// Conectar ao banco de dados.
require_once("../../notificacao/funcaoNotificacao.php");
require_once("../../conecta.php");
$conexao = conectar();

// Consulta para obter apenas os encontros com frequência registrada para o usuário, ordenados por nome do projeto
$busca_sql_user_pro = "
    SELECT 
        pro.nome_projeto, 
        en.data, 
        en.CH
    FROM projeto pro
    INNER JOIN encontro en ON en.fk_id_projeto = pro.id_projeto
    INNER JOIN frequencia fre ON fre.fk_id_encontro = en.id_encontro
    WHERE fre.fk_usuario_id_usuario = " . $_SESSION['usuario'][1] . "
    ORDER BY pro.nome_projeto ASC";

$resultado_busca_sql_user_pro = executarSQL($conexao, $busca_sql_user_pro);
$frequencias = mysqli_fetch_all($resultado_busca_sql_user_pro, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Frequências nos Projetos</title>

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
            <h3>Frequências nos Projetos</h3>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Projeto</th>
                        <th>Encontro</th>
                        <th>Carga Horária</th>
                    </tr>
                    <?php
                    $total_carga_horaria = 0;

                    foreach ($frequencias as $frequencia) {
                        $total_carga_horaria += $frequencia['CH'];

                        echo '<tr>';
                        echo '<td>' . $frequencia['nome_projeto'] . '</td>';
                        echo '<td>' . $frequencia['data'] . '</td>';
                        echo '<td>' . $frequencia['CH'] . ' horas</td>';
                        echo '</tr>';
                    }
                    ?>
                    <tr>
                        <th colspan="2">Total de Carga Horária</th>
                        <th><?php echo $total_carga_horaria; ?> horas</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
