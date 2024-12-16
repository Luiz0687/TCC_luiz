<?php
if(!isset($_SESSION['usuario'])){
    session_start();
}

if ($_SESSION['usuario'][2] == 1);
header('location: professor/professor.php');

if ($_SESSION['usuario'][2] == 2);
header('location: monitor/monitor.php');

if ($_SESSION['usuario'][2] == 3);
header('location: aluno/aluno.php');
