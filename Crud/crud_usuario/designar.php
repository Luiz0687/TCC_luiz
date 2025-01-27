<?php
// Conectar ao banco de dados.
require_once("../../conecta.php");
$conexao = conectar();

// Verificar se um ID de usuário foi enviado para alteração.
if (isset($_GET['id_usuario']) && is_numeric($_GET['id_usuario'])) {
    $id_usuario = intval($_GET['id_usuario']); // Sanitiza o ID do usuário.

    // Atualiza o tipo de usuário para 2 (Monitor) se ele for do tipo 3.
    $sql_update = "UPDATE usuario SET usuario_tipo = 2 WHERE id_usuario = $id_usuario AND usuario_tipo = 3";
    if (mysqli_query($conexao, $sql_update)) {
        header("Location: {$_SERVER['PHP_SELF']}?status=success");
        exit();
    } else {
        header("Location: {$_SERVER['PHP_SELF']}?status=error");
        exit();
    }
}

// Exibir mensagem de status.
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo "<p style='color: green; text-align: center;'>Usuário alterado para monitor com sucesso!</p>";
    } elseif ($_GET['status'] === 'error') {
        echo "<p style='color: red; text-align: center;'>Erro ao alterar o usuário. Tente novamente.</p>";
    }
}

// Seleciona usuários do tipo 3 ou 2.
$sql = "SELECT * FROM `usuario` WHERE usuario_tipo = 3 OR usuario_tipo = 2";
$resultado = mysqli_query($conexao, $sql);

// Início da tabela.
echo '<table border="1" style="border-collapse: collapse; width: 80%; margin: 20px auto; font-family: Arial, sans-serif; text-align: left;">
<tr style="background-color: #f2f2f2; border-bottom: 2px solid #ddd;">
    <th style="padding: 12px; border: 1px solid #ddd;">Nome</th>
    <th style="padding: 12px; border: 1px solid #ddd;">Email</th>
    <th style="padding: 12px; border: 1px solid #ddd;">Tipo de Usuário</th>
    <th style="padding: 12px; border: 1px solid #ddd;">Designar Monitor</th>
</tr>';

// Listar os usuários.
while ($dados = mysqli_fetch_assoc($resultado)) {
    echo '<tr style="border-bottom: 1px solid #ddd;">';
    echo '<td style="padding: 12px; border: 1px solid #ddd;">' . $dados['nome'] . '</td>';
    echo '<td style="padding: 12px; border: 1px solid #ddd;">' . $dados['email'] . '</td>';
    
    // Exibir o tipo do usuário.
    if ($dados['usuario_tipo'] == 3) {
        echo '<td style="padding: 12px; border: 1px solid #ddd;">Aluno</td>';
        echo '<td style="padding: 12px; border: 1px solid #ddd;">
                <a href="?id_usuario=' . $dados['id_usuario'] . '">Alterar este usuário para monitor</a>
              </td>';
    } elseif ($dados['usuario_tipo'] == 2) {
        echo '<td style="padding: 12px; border: 1px solid #ddd;">Monitor</td>';
        echo '<td style="padding: 12px; border: 1px solid #ddd; color: green;">Este usuário já é monitor</td>';
    }

    echo '</tr>';
}

echo '</table>';
?>
