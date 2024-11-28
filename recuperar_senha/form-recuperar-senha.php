


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/barra.ico">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../css/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/login.css">
  <title>Recuperar senha</title>
</head>

<body class="align">



  <div class="grid">
<h3>Digite seu email para recuperar sua senha</h3>
    <form action="recuperar.php" method="POST" class="form login">

      <div id="inputemail" class="form__field">
        <label for="login__username"><svg class="icon">
            <use xlink:href="#icon-user"></use>
          </svg><span class="hidden"></span></label>
        <input autocomplete="username" id="login__username" type="email" name="email" class="form__input" placeholder="Email" required>
      </div>



      <div class="form__field">
        <input type="submit" value="Recuperar">
      </div>

    </form>

    <!--     <p class="text--center">Você não tem um cadastro? <a href="inscreve.php">Cadastre-se</a> <svg class="icon">
        <use xlink:href="#icon-arrow-right"></use>
      </svg></p> -->
    <p class="text--center">Quer se logar? <a href="../index.php">Logar</a> <svg>
        <!-- <use xlink:href="#icon-arrow-right"></use> -->
      </svg></p>

  </div>

  <svg xmlns="http://www.w3.org/2000/svg" class="icons">
    <symbol id="icon-arrow-right" viewBox="0 0 1792 1792">
      <path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z" />
    </symbol>
    <symbol id="icon-lock" viewBox="0 0 1792 1792">
      <path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z" />
    </symbol>
    <symbol id="icon-user" viewBox="0 0 1792 1792">
      <path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z" />
    </symbol>
  </svg>
</body>

</html>
<?php
if ($_POST) {
  include "conecta.php";


  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $sql = "SELECT * FROM usuario where email = '$email'";
  $resultado = mysqli_query($conexao, $sql);

  if (mysqli_num_rows($resultado) == 0) {
    echo '<script>alert("Email Invalido, Tente novamente!")</script>';
    die();
  }

  $usuario = $resultado->fetch_assoc();
  $_SESSION['nivel'] = $usuario['nivel'];

  $hash = $usuario['senha'];
  $user = $usuario['nome_usuario'];


  if ($usuario == null) {
    die("Este usuario nao existe");
  }

  if (password_verify($senha, $hash) == true) {
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['user'] = $user;
    header('location: login/redire.php');
    //var_dump($_SESSION['nivel']);
  } else {
    echo '<script>alert("Senha Invalida, Tente novamente!")</script>';
  }
}
?>