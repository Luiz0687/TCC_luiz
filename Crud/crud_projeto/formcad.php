<?php
require_once "../../notificacao/funcaoNotificacao.php";
require_once "../../conecta.php";
$conexao = conectar();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Projetos</title>

    <!-- Favicon -->
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
        /* Botões de alternância estilizados */
        .toggle-group {
            display: flex;
            gap: 10px;
        }

        .toggle-btn {
            display: inline-block;
            padding: 10px 20px;
            border: 2px solid #b0bec5;
            border-radius: 20px;
            cursor: pointer;
            background-color: white;
            color: #424242;
            text-align: center;
            transition: all 0.3s ease;
        }

        .toggle-btn.active {
            background-color: black; /* Cor de fundo preta */
            color: white; /* Cor do texto branca */
            border-color: black; /* Borda preta */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
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

    <!-- Main Content -->
    <div class="container section scrollspy">
        <div class="row">
            <div class="col s12">
                <h4>Cadastro de Projeto</h4>
            </div>
        </div>

        <div class="row">
            <form action="cadastrar.php" method="post" class="col s12">
                <input type="hidden" name="id_professor" value="<?php echo $_SESSION['usuario'][1]; ?>">

                <div class="input-field">
                    <input type="text" id="nome_projeto" name="nome_projeto" required>
                    <label for="nome_projeto">Informe o nome do projeto</label>
                </div>

                <h5>Informe o Status do Projeto:</h5>
                <div class="toggle-group">
                    <div class="toggle-btn" data-value="Inativo" required>Inativo</div><br><br>
                    <div class="toggle-btn" data-value="Ativo" required>Ativo</div><br><br>
                </div>
                <input type="hidden" id="situacao" name="situacao" required><br>

                <button type="submit" class="btn waves-effect waves-light black">Cadastrar</button>
            </form>
        </div>

    </div>

    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../Style/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButtons = document.querySelectorAll('.toggle-btn');
            const situacaoInput = document.getElementById('situacao');
            const form = document.querySelector('form');

            // Adiciona evento de clique para alternar as opções
            toggleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove a classe 'active' de todos os botões
                    toggleButtons.forEach(btn => btn.classList.remove('active'));

                    // Adiciona a classe 'active' ao botão clicado
                    button.classList.add('active');

                    // Atualiza o valor do campo oculto
                    situacaoInput.value = button.getAttribute('data-value');
                });
            });

            // Validação no envio do formulário
            form.addEventListener('submit', (event) => {
                if (!situacaoInput.value) {
                    event.preventDefault(); // Impede o envio do formulário
                    alert('Por favor, selecione o status do projeto (Ativo ou Inativo).');
                }
            });
        });
    </script>
</body>

</html>
