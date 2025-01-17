<?php
include_once("notificacao/funcaoNotificacao.php");
include_once("conecta.php");
$conexao = conectar();

if ($_POST) {

  $email = $_POST['email'];
  $senha = $_POST['senha'];

  //verificar se o email existe no banco de dados.
  $sql = "SELECT * FROM usuario WHERE email = '$email'";

  //excutar o comando $sql_busca.
  $execucao = mysqli_query($conexao, $sql);

  $quantidade = $execucao->num_rows;

  if ($quantidade != 0) {

    $dados = mysqli_fetch_assoc($execucao);

    $_SESSION['usuario'][0] = $dados['nome'];
    $_SESSION['usuario'][1] = $dados['id_usuario'];
    $_SESSION['usuario'][2] = $dados['usuario_tipo'];
    //var_dump($dados['usuario_tipo']);die;

    if (password_verify($senha, $dados['senha'])) {

      if ($_SESSION['usuario'][2] == 1) {

        header("location: login/professor/professor.php");
      } else {

        if ($_SESSION['usuario'][2] == 2) {

          header("location: login/monitor/monitor.php");
        } else {

          if ($_SESSION['usuario'][2] == 3) {

            header("location: login/aluno/aluno.php");
          }
        }
      }
    } else {

      notificacoes(2, "Senha inválida.");
    }
  } else {

    notificacoes(2, "Email está incorreto.");
  }
}

?>



<!DOCTYPE html>
<html lang='pt-BR' class=''>

<head>

  <meta charset='UTF-8'>
  <title>ProjetoFácil</title>

  <meta name="robots" content="noindex">

  <link rel="shortcut icon" type="image/x-icon" href="Style/images/icone.jpg">
  <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
  <link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />


  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    section {
      position: relative;
      min-height: 100vh;
      background-color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    section .container {
      position: relative;
      width: 800px;
      height: 500px;
      background: #fff;
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    section .container .user {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
    }

    section .container .user .imgBx {
      position: relative;
      width: 50%;
      height: 100%;
      background: black;
      transition: 0.5s;
    }

    section .container .user .imgBx img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    section .container .user .formBx {
      position: relative;
      width: 50%;
      height: 100%;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
      transition: 0.5s;
    }

    section .container .user .formBx form h2 {
      font-size: 18px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-align: center;
      width: 100%;
      margin-bottom: 10px;
      color: #555;
    }

    section .container .user .formBx form input {
      position: relative;
      width: 100%;
      padding: 10px;
      background: #f5f5f5;
      color: #333;
      border: none;
      outline: none;
      box-shadow: none;
      margin: 8px 0;
      font-size: 14px;
      letter-spacing: 1px;
      font-weight: 300;
    }

    section .container .user .formBx form input[type='submit'] {
      max-width: 100px;
      background: black;
      color: #fff;
      cursor: pointer;
      font-size: 14px;
      font-weight: 500;
      letter-spacing: 1px;
      transition: 0.5s;
    }

    section .container .user .formBx form .signup {
      position: relative;
      margin-top: 20px;
      font-size: 12px;
      letter-spacing: 1px;
      color: #555;
      text-transform: uppercase;
      font-weight: 300;
    }

    section .container .user .formBx form .signup a {
      font-weight: 600;
      text-decoration: none;
      color: #677eff;
    }

    section .container .signupBx {
      pointer-events: none;
    }

    section .container.active .signupBx {
      pointer-events: initial;
    }

    section .container .signupBx .formBx {
      left: 100%;
    }

    section .container.active .signupBx .formBx {
      left: 0;
    }

    section .container .signupBx .imgBx {
      left: -100%;
    }

    section .container.active .signupBx .imgBx {
      left: 0%;
    }

    section .container .signinBx .formBx {
      left: 0%;
    }

    section .container.active .signinBx .formBx {
      left: 100%;
    }

    section .container .signinBx .imgBx {
      left: 0%;
    }

    section .container.active .signinBx .imgBx {
      left: -100%;
    }

    @media (max-width: 991px) {
      section .container {
        max-width: 400px;
      }

      section .container .imgBx {
        display: none;
      }

      section .container .user .formBx {
        width: 100%;
      }
    }
  </style>


</head>

<body>

  <body>
    <section>
      <div class="container">
        <div class="user signinBx">
          <div class="imgBx"><img src="Style/images/logsbot.jpg" alt="" /></div>
          <div class="formBx">

            <form action="" method="post">
              <h2>Fazer Login</h2>
              <input type="text" name="email" placeholder="e-mail" required />
              <input type="password" name="senha" placeholder="senha" required/>
              <input type="submit" value="Entrar" />
              <p class="signup">
                Esqueceu a senha ?
                <a href="recuperar_senha/form-recuperar-senha.php">Recuperar.</a>
              </p>
              <p class="signup">
                Ainda não tem uma conta ?
                <a href="#" onclick="toggleForm();">Cadastre-se.</a>
              </p>
            </form>

          </div>
        </div>
        <div class="user signupBx">
          <div class="formBx">
            <form action="Login/cadastrar.php" method="post">
              <h2>Registrar</h2>
              <input type="hidden" name="usuario_tipo" value="3">
              <input type="text" name="nome" placeholder="nome" required />
              <input type="email" name="email" placeholder="e-mail" required />
              <input type="password" name="senha" placeholder="senha" required />
              <input type="password" name="repetir_senha" placeholder="confirme senha" required />
              <input type="submit" name="" value="Cadastrar" />
              <p class="signup">
                Já tem uma conta ?
                <a href="#" onclick="toggleForm();">Fazer login.</a>
              </p>
            </form>
          </div>
          <div class="imgBx"><img src="Style/images/logsbot.jpg" alt="" /></div>
        </div>
      </div>
    </section>

    <script>
      const toggleForm = () => {
        const container = document.querySelector('.container');
        container.classList.toggle('active');
      };
    </script>
  </body>


</html>