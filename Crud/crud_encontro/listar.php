<?php
// Conectar ao banco de dados.
require_once("../../notificacao/funcaoNotificacao.php");
require_once("../../conecta.php");
$conexao = conectar();



echo '<link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
<link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
<link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">' ;

// Seleciona todos os dados da tabela
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Projeto</title>

    <!-- CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
    <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
    <link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">
    
    <link href="../../Style/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../../Style/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

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
        .actions-btn {
            padding: 8px 16px;
            margin: 5px;
            color: white;
            background-color:rgb(0, 0, 0);
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .actions-btn:hover {
            background-color:rgb(137, 151, 149);
        }
        .btn-delete {
            background-color:rgb(175, 74, 74);
            color: white;
        }
        .btn-delete:hover {
            background-color: #d32f2f;
        }
        .btn-link {
            color:rgb(0, 0, 0);
            text-decoration: none;
            font-weight: bold;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
        .btn-frequency {
            background-color: #000000;
            color: white;
            
        }
        .btn-frequency:hover {
            background-color:rgb(137, 151, 149)
        }
    </style>
</head>

<body>
    <div id="navbar" class="navbar-fixed scrollspy">
        <nav class="white">
            <div class="nav-wrapper container">
                <div class="container">
                    <a class="brand-logo"><img src="../../Style/images/logo.svg" style="height: 50px;"></a>
                </div>
                <a href="" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                <ul class="right hide-on-med-and-down">
                  
                    <li><a href="../../Login/professor/professor.php">Voltar</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container section scrollspy">
        <div class="section">
            <div class="row">
                <div class="col s9">
                    <h3>Encontros do Projeto</h3>
                </div>
            </div>

            <div class="row">
                <?php
          
             $id_projeto = isset($_GET['id_projeto']) ? $_GET['id_projeto'] : null;
             
             if ($id_projeto === null) {
                 die('ID do projeto não fornecido.');
             }
             
             $id_projeto = mysqli_real_escape_string($conexao, $id_projeto);
             
             $sql = "SELECT pro.nome_projeto, pro.situacao, en.CH, en.data, en.id_encontro 
                     FROM projeto pro 
                     INNER JOIN encontro en ON pro.id_projeto = en.fk_id_projeto
                     WHERE pro.id_projeto = '$id_projeto'";
             
             $resultado = mysqli_query($conexao, $sql);
             
             if ($resultado === false) {
                 die('Erro na consulta SQL: ' . mysqli_error($conexao));
             }
             
             $lstDados = [];
             while ($dados = mysqli_fetch_assoc($resultado)) {
                 $lstDados[] = $dados;
             }
             
             if (count($lstDados) == 0) {
                 echo '<h5>Este projeto não possui encontros.</h5>';
             } else {
                 echo '<h4>' . $lstDados[0]['nome_projeto'] . '</h4>';
             }
             
             echo '<div class="table-container">';
             echo '<table>';
             echo '<tr><th>Data</th><th>CH</th><th>Situação</th><th colspan="2">Ações</th></tr>';
             
             foreach ($lstDados as $dados) {
                 echo '<tr>';
                 echo '<td>' . $dados['data'] . '</td>';
                 echo '<td>' . $dados['CH'] . '</td>';
                 echo '<td>' . $dados['situacao'] . '</td>';
                 echo '<td><a href="../crud_frequencia/chamada.php?id_encontro=' . $dados['id_encontro'] . '" class="actions-btn btn-frequency">Frequência</a></td>';
                 echo '<td><a href="excluir.php?id_encontro=' . $dados['id_encontro'] . '" class="actions-btn btn-delete"><img src="imagens/excluir.png" width="20" height="20" alt="Excluir"></a></td>';
                 echo '</tr>';
             }
             
             echo '</table>';
             echo '</div>';
             
             echo '<div style="margin-top: 20px;">
                 <a href="../../Crud/crud_encontro/formcad.php?id_projeto=' . $id_projeto . '" class="actions-btn">Inserir Encontro</a>
             </div>';
             
                ?>
            </div>
        </div>
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
