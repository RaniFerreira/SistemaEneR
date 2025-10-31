<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Verifica se síndico está logado
if (!isset($_SESSION["id_sindico"])) {
    header("Location: index.php");
    exit;
}


$pagina = $_GET["pagina"] ?? "home";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Síndico</title>
    <link rel="stylesheet" href="/sistemaEneR/visao/css/estilo_painel_sindico.css">
    <link rel="stylesheet" href="/sistemaEneR/visao/css/estilo_cadastro_morador.css">
    <script src="https://kit.fontawesome.com/a2e0e9a09f.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="sidebar">
    <div>
        <div class="sidebar-header">
            <h2><i class="fa-solid fa-user-tie"></i> Síndico</h2>
            <p><?= $_SESSION["nome_usuario"] ?></p>
        </div>

        <div class="menu">
            <a href="?pagina=cadastrar_morador"><i class="fa-solid fa-user-plus"></i> Cadastrar Morador</a>
            <a href="?pagina=listarMoradores"><i class="fa-solid fa-user-plus"></i> Moradores</a>
            <a href="?pagina=gerenciar_boletos"><i class="fa-solid fa-file-invoice-dollar"></i> Gerenciar Boletos</a>
            <a href="?pagina=correcao"><i class="fa-solid fa-pen-to-square"></i> Solicitar Correção</a>
            <a href="?pagina=reclamacoes"><i class="fa-solid fa-list-check"></i> Ouvidoria</a>
        </div>
    </div>

    <a href="../controle/Logout_class.php" class="logout">
        <i class="fa-solid fa-right-from-bracket"></i> Sair
    </a>
</div>

<div class="main-content">
    <?php if ($pagina !== "cadastrar_morador") : ?>
<header>
    <h2><i class="fa-solid fa-building"></i> Painel do Síndico</h2>
</header>
<?php endif; ?>

    <div class="card">
        <?php
        switch($pagina) {
            case "cadastrar_morador":
              
                // Formulário para cadastrar morador
                 ?>
                <div class="container">
                    <h2>Cadastrar Morador</h2>
                   

                    <form action="../Morador.php?fun=cadastrarMorador" method="POST">
                         <!-- 🔹 Mensagem de sucesso ou erro -->
                    <?php if (isset($_SESSION['status'])): ?>
                        <p style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; 
                                padding: 10px; border-radius: 5px; text-align: center;">
                            <?= $_SESSION['status'] ?>
                        </p>
                        <?php unset($_SESSION['status']); // Remove para não mostrar de novo ?>
                    <?php endif; ?>
                        <!-- Dados do Usuário -->
                        <label for="nome_usuario">Nome de Usuário:</label>
                        <input type="text" name="nome_usuario" id="nome_usuario" required>

                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" required>

                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" required>

                        <!-- Dados do Morador -->
                        <label for="nome_morador">Nome do Morador:</label>
                        <input type="text" name="nome_morador" id="nome_morador" placeholder="Nome completo" required>

                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" id="telefone" placeholder="(11) 98888-8888" required>

                        <label for="condominio">Nome do Condomínio:</label>
                        <input type="text" name="condominio" id="condominio" required>

                        <input type="submit" value="Cadastrar Morador">
                    </form>
                </div>
                <?php
                break;
            case "listarMoradores":
               
                // Listagem de boletos com opções de editar/deletar
                include_once(__DIR__ . "/../controle/moradorControle/ListarMorador_class.php");
                
                $listarMoradorObj = new ListarMorador($_SESSION["id_sindico"]);
                $moradores = $listarMoradorObj->getMoradores();
                ?>

                    <h3><i class='fa-solid fa-users'></i> Moradores do Condomínio <?= htmlspecialchars($_SESSION['nome_condominio']) ?></h3>


                       <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome do Morador</th>
                                    <th>Telefone</th>
                                    <th>Nome de Usuário</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($moradores as $m): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($m['id_morador']) ?></td>
                                        <td><?= htmlspecialchars($m['nome_morador']) ?></td>
                                        <td><?= htmlspecialchars($m['telefone']) ?></td>
                                        <td><?= htmlspecialchars($m['nome_usuario']) ?></td>
                                        <td><?= htmlspecialchars($m['email']) ?></td>
                                        <td>
                                            <!-- Editar -->
                                            <a href="?pagina=editar_morador&id=<?= $m['id_morador'] ?>" style="color: #0288d1;">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            &nbsp;
                                            <!-- Excluir -->
                                            <a href="../Morador.php?acao=excluir&id=<?= $m['id_morador'] ?>" 
                                            onclick="return confirm('Tem certeza que deseja excluir este morador?');" 
                                            style="color: #d32f2f;">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php
                break;

            case "gerenciar_boletos":
               
                // Listagem de boletos com opções de editar/deletar
                break;

            case "correcao":
              
                // Formulário para correções
                break;

            case "reclamacoes":
                
                // Listagem completa com opções de atualizar/deletar
                break;

            default:
               ?>
    <div style="text-align: center; margin-top: 100px;">
        <h2 style="color: #0288d1; font-family: Arial, sans-serif;">
            👋 Bem-vindo(a), <?= htmlspecialchars($_SESSION["nome_usuario"]) ?>!
        </h2>
        <p style="font-size: 18px; color: #555;">
            Use o menu lateral para navegar pelas opções do sistema.
        </p>
        <div style="font-size: 50px; color: #0288d1; margin-top: 20px;">
             ⬅️
        </div>
        <p style="color: #888; font-size: 14px;">
            Clique em uma das opções ao lado.
        </p>
    </div>
    <?php
        }
        ?>
    </div>
</div>

</body>
</html>
