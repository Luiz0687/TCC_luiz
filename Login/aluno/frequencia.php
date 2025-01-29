<?php
// Conectar ao banco de dados.
require_once("../../notificacao/funcaoNotificacao.php");
require_once("../../conecta.php");
$conexao = conectar();

// Verificar se o ID do projeto foi enviado como parâmetro.
if (isset($_GET['id_projeto']) && is_numeric($_GET['id_projeto'])) {
    $id_projeto = intval($_GET['id_projeto']);

    // Consulta para obter os encontros e frequência do projeto específico.
    $busca_sql_user_pro = "
        SELECT 
            pro.nome_projeto, 
            en.data, 
            en.CH
        FROM projeto pro
        INNER JOIN encontro en ON en.fk_id_projeto = pro.id_projeto
        INNER JOIN frequencia fre ON fre.fk_id_encontro = en.id_encontro
        WHERE fre.fk_usuario_id_usuario = " . $_SESSION['usuario'][1] . "
          AND pro.id_projeto = $id_projeto
        ORDER BY en.data ASC";

    $resultado_busca_sql_user_pro = executarSQL($conexao, $busca_sql_user_pro);
    $frequencias = mysqli_fetch_all($resultado_busca_sql_user_pro, MYSQLI_ASSOC);
} else {
    // Redireciona de volta caso o ID do projeto não seja válido.
    echo "<script>alert('Projeto inválido!'); window.location.href = 'minhaInscricoes.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Frequências no Projeto</title>

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
            <h3>Frequências no Projeto</h3>
            <div class="table-container">
                <?php if (!empty($frequencias)): ?>
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
                            echo '<td>' . htmlspecialchars($frequencia['nome_projeto']) . '</td>';
                            echo '<td>' . htmlspecialchars(date('d/m/Y', strtotime($frequencia['data']))) . '</td>';
                            echo '<td>' . htmlspecialchars($frequencia['CH']) . ' horas</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>
                            <th colspan="2">Total de Carga Horária</th>
                            <th><?php echo $total_carga_horaria; ?> horas</th>
                        </tr>
                    </table>
                <?php else: ?>
                    <p>Não há frequência registrada para este projeto.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
