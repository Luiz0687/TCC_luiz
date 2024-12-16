<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION)){
   echo " <script>alert('Você não está logado no sistema!');
   window.location.href=window.location.origin +'/TCC/index.php';
   </script>";
     die;
}
if ($_SESSION['usuario'][2] == 1);
header('location: professor/professor.php');

if ($_SESSION['usuario'][2] == 2);
header('location: monitor/monitor.php');

if ($_SESSION['usuario'][2] == 3);
header('location: aluno/aluno.php');
