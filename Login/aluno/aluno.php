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

    
                
            

    

        

            <div class="row">

             <?php
             require_once "listarProjeto.php";
             ?>

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