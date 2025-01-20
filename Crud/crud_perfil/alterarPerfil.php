<?php
require_once "../../notificacao/funcaoNotificacao.php"; // Notificações
require_once "../../conecta.php"; // Conectar ao banco

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../Login/professor/professor.php");
    exit;
}

// Conectar ao banco
$conexao = conectar();

// Buscar os dados do usuário logado
$sql = "SELECT * FROM usuario WHERE id_usuario = " . $_SESSION['usuario'][1];
$query = executarSQL($conexao, $sql);
$usuario = mysqli_fetch_assoc($query);

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $id_usuario = $_SESSION['usuario'][1]; // Obtendo o ID do usuário logado

    // Verificar se os campos foram preenchidos
    if ($nome && $email) {
        // Atualizar nome e email no banco de dados
        $sql = "UPDATE usuario SET nome = ?, email = ? WHERE id_usuario = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $nome, $email, $id_usuario);

        if (mysqli_stmt_execute($stmt)) {
            echo "Perfil atualizado com sucesso!";
            // Redirecionar para a página do perfil ou para a página desejada
            header("Location: inicial.php");
            exit;
        } else {
            echo "Erro ao atualizar o perfil.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Alterar Perfil</title>

    <!-- CSS  -->
    <link rel="shortcut icon" type="image/x-icon" href="../../Style/images/icone.jpg">
    <link href="../../Style/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../../Style/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    <style>
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
                    <a href="../../Login/professor/professor.php">Voltar</a>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container section scrollspy">
        <div class="section">
            <h3>Altere seu perfil</h3>

            <!-- Formulário para editar o perfil -->
            <form action="alterarPerfil.php" method="post">
                <label for="nome">Edite seu Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>"><br><br>

                <label for="email">Edite seu email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($usuario['email']); ?>"><br><br>

                <div style="margin-top: 20px;">
                    <input type="submit" value="Alterar perfil" class="actions-btn"><br><br>
                </div>
            </form>
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
