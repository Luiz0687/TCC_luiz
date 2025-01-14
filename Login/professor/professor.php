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

                    <li><a href=""  > Projetos</a></li>
                    <li><a href="../../Crud/crud_perfil/inicial.php"  >Meu Perfil</a></li>
                    <li><a href="../../index.php"  >Sair</a></li>

                </ul>
                <ul class="right side-nav" id="mobile-demo">
                    <li><a class="head-link" href="">Meus Projetos</a></li>
                    <li><a class="head-link" href="../../Crud/crud_perfil/inicial.php">Meu Perfil</a></li>
                    <li><a class="head-link" href="../../index.php">Sair</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container section scrollspy">
        <div class="section">

            <div class="row">

                <div class="col s9">
                    <h4>Meus Projetos</h4>
                </div>
                <div class="col s3">
                    <div>
                        <a href="../../Crud/crud_projeto/formcad.php" class="waves-effect waves-light black btn-large"><i class="material-icons left">add_box</i>criar novo projeto</a>
                    </div>
                </div>
            </div>

            <div class="row">

             <?php

             require_once "../../Crud/crud_projeto/listar.php";
             ?>

            </div>
        </div>
    </div>


    <footer class="page-footer black lighten-1">

        <div class="footer-copyright">
            <div class="container">
                <p>Copyright ©2025 Luiz</p>
            </div>
        </div>
    </footer>


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


</body>

</html>