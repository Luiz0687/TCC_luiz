<?php

//NOTIFICAÇÕES.PHP

//Esse é o arquivo onde são geradas as notificações do sistema.

//devemos incluir este arquivo onde irão aparecer notificações do sistema. Como iniciamos a sessão aqui, quando incluimos em outro arquivo, não iremos iniciar outra.

//iniciar a sessão.
session_start();

//o comando session_regenerate_id(true) serve para gerar um novo ID para sessão, removendo a sessão antiga, ajudando a proteger contra possíveis ataques.
session_regenerate_id(true);

//criar a função que recebe o tipo de notificação (de sucesso, erre etc) e a notificação (mensagem que aparece para o usuário que excutou a ação).
function notificacoes($tipoNotificacao, $notificacao)
{

    //tendo o tipo de notificação e notificação em mãos, agora atribuimos esses valores a uma sesão.
    $_SESSION['notificacoes'][0] = $tipoNotificacao;
    $_SESSION['notificacoes'][1] = $notificacao;
}

//criar a função que irá imprimir as notificações para o usuário.
function exibirNotificacoes()
{

    // Verificar se existe algum tipo de notificação no sistema.
    if (isset($_SESSION['notificacoes'][0])) {

        //se existir verificamos qual é o tipo de nificação que há. Se for com o valor 1 na posição [0], quer dizer que a notificação é de que algo deu certo.
        if ($_SESSION['notificacoes'][0] == 1) {

            //criamos uma paragrafo para imprimir a notificação, verde é porque algo deu certo.
            echo '<p style="color: green;">' . $_SESSION['notificacoes'][1] . '</p>';
        } else {

            //Se for com o valor 2 na posição [0], quer dizer que a notificação é de que algo deu errado.
            if ($_SESSION['notificacoes'][0] == 2) {

                //criamos uma paragrafo para imprimir a notificação, vermelho é porque algo deu errado.
                echo '<p style="color: red;">' . $_SESSION['notificacoes'][1] . '</p>';
            }
        }
    }
}

function limpaNotificacoes()
{

    //unset() é usado para destruir variáveis específicas. Basicamente, ele remove a variável e a memória associada a ela. Funciona com variáveis normais, variáveis de sessão, e até elementos de arrays.
    // Limpar a notificação da sessão.
    unset($_SESSION['notificacoes']);
}