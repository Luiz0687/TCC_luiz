<?php
// Iniciar a sessão
require_once "../../notificacao/funcaoNotificacao.php"; // Notificações
require_once "../../conecta.php"; // Conectar ao banco

// Conectar ao banco de dados
$mysql = conectar();

// Deletar o usuário do banco de dados
$sql = "DELETE FROM usuario WHERE id_usuario = " . $_SESSION['usuario'][1];
if (executarSQL($mysql, $sql)) {
    // Destruir a sessão e redirecionar para a página de logout
    session_destroy();
    header("Location: ../../index.php");
    exit;
} else {
    echo "Erro ao excluir o perfil. Tente novamente.";
}
?>
