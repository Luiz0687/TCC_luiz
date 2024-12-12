<?php

//inicio da sessão
session_start();

//configuração da sessão
session_regenerate_id(true);

//função de receber os valores da notificação
function notificacoes($tipoNotificacao,$notificacao){

    $_SESSION['notificacoes'][0] = $tipoNotificacao;
    $_SESSION['notificacoes'][1] = $notificacao;
}

 function exibirNotificacoes(){

      if(isset)




 }

      
?>






















