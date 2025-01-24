<?php
// Conectar ao banco de dados
require_once "../../conecta.php";

// Iniciar a sessão
session_start();

// Obter ID do usuário da sessão
$id_usuario = $_SESSION['usuario'][1];

// Conectar ao banco
$conexao = conectar();

// Consultar os dados do usuário
$sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
$query = executarSQL($conexao, $sql);

// Verificar se existe usuário
$usuario = mysqli_fetch_assoc($query);

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
        .actions-btn {
            padding: 8px 16px;
            margin: 5px;
            color: white;
            background-color: rgb(0, 0, 0);
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .actions-btn:hover {
            background-color: rgb(137, 151, 149);
        }

        /* Botão de excluir */
        .delete-btn {
            position: fixed;
            bottom: 430px;
            right: 1450px;
            padding: 12px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: red;
        }

        /* Caixa de confirmação */
        .confirm-box {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .confirm-box button {
            padding: 8px 16px;
            margin: 5px;
        }

        .confirm-box .confirm-btn {
            background-color: red;
            color: white;
            border: none;
        }

        .confirm-box .cancel-btn {
            background-color: #ccc;
            color: black;
            border: none;
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

            <!-- Formulário de alteração -->
            <form action="alterarPerfil.php" method="post">
                <label for="nome">Edite seu Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome']; ?>"><br><br>

                <label for="email">Edite seu email:</label>
                <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>"><br><br>

                <div style="margin-top: 20px;">
                    <input type="submit" value="Alterar perfil" class="actions-btn"><br><br>
                </div>
            </form>
        </div>
    </div>

    <!-- Botão de excluir perfil -->
    <button class="delete-btn" id="deleteBtn">Excluir Perfil</button>

    <!-- Caixa de confirmação -->
    <div class="confirm-box" id="confirmBox">
        <p>Deseja realmente excluir seu perfil?</p>
        <button class="confirm-btn" id="confirmDelete">Sim</button>
        <button class="cancel-btn" id="cancelDelete">Não</button>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="../../Style/js/materialize.js"></script>
    <script src="../../Style/js/init.js"></script>

    <script>
        // Exibir a caixa de confirmação ao clicar no botão de excluir
        document.getElementById('deleteBtn').addEventListener('click', function () {
            document.getElementById('confirmBox').style.display = 'block';
        });

        // Cancelar a exclusão
        document.getElementById('cancelDelete').addEventListener('click', function () {
            document.getElementById('confirmBox').style.display = 'none';
        });

        // Confirmar a exclusão
        document.getElementById('confirmDelete').addEventListener('click', function () {
            // Redireciona para a página de exclusão do perfil
            window.location.href = "excluirPerfil.php";
        });
    </script>
</body>

</html>
