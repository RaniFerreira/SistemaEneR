<?php
// Inicia a sessão
session_start();

// Encerra todas as variáveis de sessão
session_unset();
session_destroy();

// Redireciona para a página de login
header("Location: ../visao/form_login.php"); // ajusta o caminho conforme a localização do seu Login.php
exit;
?>
