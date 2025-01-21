<?php
include_once "../../notificacao/funcaoNotificacao.php";
include_once "../../conecta.php";
$conexao = conectar();

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

                  
                    <li><a href="../../index.php" >Sair</a></li>

                </ul>
            </div>
        </nav>
    </div>

    <div class="container section scrollspy">
        <div class="section">


            </div>

            <div class="options-container">
    <?php  
    echo "<h3>Olá, " . $_SESSION['usuario'][0] . "</h3>";
    ?>
    <a href="listarProjeto.php" class="btn-option">Projetos disponíveis</a><br>
    <a href="minhaInscricoes.php" class="btn-option">Minhas inscrições</a><br>
    <a href="frequencia.php" class="btn-option">Minhas frequências</a><br>
    <a href="emitirCertificado.php" class="btn-option">Emitir Certificado</a><br>
</div>

<style>
    .options-container {
        text-align: left; /* Alinha as opções à esquerda */
        margin: 20px auto;
        max-width: 300px; /* Define uma largura máxima para as opções */
    }

    .btn-option {
        display: block;
        margin: 10px 0;
        padding: 12px 20px;
        text-decoration: none;
        color: #fff;
        background-color: #000; /* Cor preta para o fundo */
        border-radius: 5px;
        font-size: 18px;
        text-align: center;
        transition: background-color 0.3s ease, transform 0.2s ease; /* Transição suave */
    }

    .btn-option:hover {
        background-color: #444; /* Cor mais clara no hover */
        transform: scale(1.05); /* Efeito de aumento ao passar o mouse */
    }

    /* Adicionando um pouco de sombra para um efeito 3D */
    .btn-option:active {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    /* Adicionando um pouco de espaçamento nas opções */
    .options-container a {
        padding-left: 15px;
        padding-right: 15px;
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
        <?php
    
