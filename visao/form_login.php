<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Sistema</title>
    <link rel="stylesheet" href="/sistemaEneR/visao/css/estilo_login.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        

        <form action="../controle/AutenticarLogin_class.php" method="POST">
            <?php
$mensagem = $_GET['erro'] ?? '';
?>
<?php if (!empty($mensagem)) : ?>
    <p id="mensagem" class="<?= strpos($mensagem, '❌') !== false ? 'erro' : 'sucesso' ?>">
        <?= htmlspecialchars($mensagem) ?>
    </p>

    <script>
        // Após 7 segundos (7000 ms), oculta a mensagem
        setTimeout(() => {
            const msg = document.getElementById('mensagem');
            if (msg) {
                msg.style.transition = 'opacity 0.5s ease';
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 500); // remove após o fade
            }
        }, 7000);
    </script>
<?php endif; ?>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <input type="submit" value="Entrar">
        </form>

        <p class="cadastro">
            Ainda não tem conta?
            <a href="/sistemaEneR/visao/form_cadastro_sindico.php">Cadastre-se</a>
        </p>
    </div>
    
</body>
</html>
