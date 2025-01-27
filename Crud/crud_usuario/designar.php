
<?php
require_once "../../notificacao/funcaoNotificacao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Projeto</title>

    <!-- CSS  -->
    
    <link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
    <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
    <link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">
    
    <link href="../../Style/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../../Style/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

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

                
                    <li><a href="../../Login/professor/designar.php"  >Sair</a></li>

                </ul>
                <ul class="right side-nav" id="mobile-demo">
                    <li><a class="head-link" href="professor.php">Sair</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container section scrollspy">
        <div class="section">

          

        <div class="col s9">
    <h5 style="margin-left: 113px;">Selecione o usuário que deseja designar monitor.</h2>
</div>

                <div class="col s3">
                   
                </div>
            </div>

            <div class="row">

            <?php
// Conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

// Verificar se um ID de usuário foi enviado para alteração.
if (isset($_GET['id_usuario']) && is_numeric($_GET['id_usuario'])) {
    $id_usuario = intval($_GET['id_usuario']); // Sanitiza o ID do usuário.

    // Atualiza o tipo de usuário para 2 (Monitor) se ele for do tipo 3.
    $sql_update = "UPDATE usuario SET usuario_tipo = 2 WHERE id_usuario = $id_usuario AND usuario_tipo = 3";
    if (mysqli_query($conexao, $sql_update)) {
        header("Location: {$_SERVER['PHP_SELF']}?status=success");
        exit();
    } else {
        header("Location: {$_SERVER['PHP_SELF']}?status=error");
        exit();
    }
}

// Exibir mensagem de status.
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo "<p style='color: green; text-align: center;'>Usuário alterado para monitor com sucesso!</p>";
    } elseif ($_GET['status'] === 'error') {
        echo "<p style='color: red; text-align: center;'>Erro ao alterar o usuário. Tente novamente.</p>";
    }
}

// Seleciona usuários do tipo 3 ou 2.
$sql = "SELECT * FROM `usuario` WHERE usuario_tipo = 3 OR usuario_tipo = 2";
$resultado = mysqli_query($conexao, $sql);


// Início da tabela.
echo '<table border="1" style="border-collapse: collapse; width: 80%; margin: 20px auto; font-family: Arial, sans-serif; text-align: left;">
<tr style="background-color: #f2f2f2; border-bottom: 2px solid #ddd;">
    <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Nome</th>
    <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Email</th>
    <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Tipo de Usuário</th>
    <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Designar Monitor</th>
</tr>';


// Listar os usuários.
while ($dados = mysqli_fetch_assoc($resultado)) {
    echo '<tr style="border-bottom: 1px solid #ddd;">';
    echo '<td style="padding: 12px; border: 1px solid #ddd;">' . $dados['nome'] . '</td>';
    echo '<td style="padding: 12px; border: 1px solid #ddd;">' . $dados['email'] . '</td>';
    
    // Exibir o tipo do usuário.
    if ($dados['usuario_tipo'] == 3) {
        echo '<td style="padding: 12px; border: 1px solid #ddd;">Aluno</td>';
        echo '<td style="padding: 12px; border: 1px solid #ddd;">
                <a href="?id_usuario=' . $dados['id_usuario'] . '" class="alterar-link ">Alterar Usuário para Monitor</a>
              </td>';
    } elseif ($dados['usuario_tipo'] == 2) {
        echo '<td style="padding: 12px; border: 1px solid #ddd;">Monitor</td>';
        echo '<td style="padding: 12px; border: 1px solid #ddd; color: red;">Este usuário já é monitor deste projeto.</td>';
    }

    echo '</tr>';
}

echo '</table>';
?>

<!-- Estilos CSS para o link -->
<style>
a.alterar-link {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

a.alterar-link:hover {
    color: #0056b3;
    text-decoration: underline;
}
</style>


            </div>
        </div>
    </div>

    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="../../Style/js/materialize.js"></script>
    <script src="../../Style/js/init.js"></script>
    <script>
        $(document).ready(function() {
            $('.materialboxed').materialbox();
            $('.button-collapse').sideNav();

        });
    </script>
    <script>
        $('.head-link').click(function(e) {
            e.preventDefault();

            var goto = $(this).attr('href');

            $('html, body').animate({
                scrollTop: $(goto).offset().top
            }, 800);
        });
    </script>

<!-- Modal Trigger -->

</body>

</html>


