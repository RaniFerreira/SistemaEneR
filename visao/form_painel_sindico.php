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
    <script src="/sistemaEneR/visao/js/confirmacaoPagamento.js"></script>
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
             <a href="?pagina=consumo"><i class="fa-solid fa-user-plus"></i> Gerenciar Consumos</a>
            <a href="?pagina=gerenciar_boletos"><i class="fa-solid fa-file-invoice-dollar"></i> Gerenciar Boletos</a>
            <a href="?pagina=correcao"><i class="fa-solid fa-pen-to-square"></i> Solicitar Correção</a>
            <a href="?pagina=reclamacoes"><i class="fa-solid fa-pen-to-square"></i> Reclamações</a>
            <a href="?pagina=ouvidoria"><i class="fa-solid fa-list-check"></i> Ouvidoria</a>
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
                <tr style="border-bottom:1px solid #ddd;">
                    <td><?= htmlspecialchars($m['id_morador']) ?></td>
                    <td><?= htmlspecialchars($m['nome_morador']) ?></td>
                    <td><?= htmlspecialchars($m['telefone']) ?></td>
                    <td><?= htmlspecialchars($m['nome_usuario']) ?></td>
                    <td><?= htmlspecialchars($m['email']) ?></td>
                    <td style="text-align:center;">
                        <!-- Botão Editar (abre o modal) -->
                        <button class="btn-editar"
                            onclick="abrirModal(
                                '<?= $m['id_morador'] ?>',
                                '<?= htmlspecialchars($m['nome_morador']) ?>',
                                '<?= htmlspecialchars($m['telefone']) ?>',
                                '<?= htmlspecialchars($m['nome_usuario']) ?>',
                                '<?= htmlspecialchars($m['email']) ?>'
                            )"
                            style="background-color:#0288d1; color:white; padding:6px 10px;
                                   border-radius:5px; border:none; cursor:pointer; font-size:14px;">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </button>

                                                    <!-- Botão Excluir -->
                            <button class="btn-excluir"
                                onclick="abrirModalExcluir(
                                    '<?= $m['id_morador'] ?>',
                                    '<?= htmlspecialchars($m['nome_morador']) ?>'
                                )"
                                style="background-color:#d32f2f; color:white; padding:6px 10px;
                                    border-radius:5px; border:none; cursor:pointer; font-size:14px;">
                                <i class="fa-solid fa-trash"></i> Excluir
                            </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Inclui o modal de edição -->
    <?php include(__DIR__ . "/../visao/form_modal_editar_morador.php"); ?>
    <link rel="stylesheet" href="../visao/css/estilo_modal_editar_morador.css">
    <script src="../visao/js/modalEditarMorador.js"></script>

    <!-- Inclui o modal de exclusão -->
    <?php include(__DIR__ . "/../visao/form_modal_excluir_morador.php"); ?>
    <link rel="stylesheet" href="../visao/css/estilo_modal_excluir_morador.css">
    <script src="../visao/js/modalExcluirMorador.js"></script>
        
    <?php
    break;


            case "gerenciar_boletos":
               
               include_once(__DIR__ . "/../controle/moradorControle/ListarMorador_class.php");
    include_once(__DIR__ . "/../controle/boletoControle/ListarBoleto_class.php");

    // ✅ PRIMEIRO PASSO — LISTAR MORADORES DO SÍNDICO
    if (!isset($_GET["id_morador"])) {

        $listarMoradorObj = new ListarMorador($_SESSION["id_sindico"]);
        $moradores = $listarMoradorObj->getMoradores();
        ?>

        <h3><i class="fa-solid fa-users"></i> Selecione um Morador para Visualizar os Boletos</h3>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Morador</th>
                    <th>Telefone</th>
                    <th>Ver Boletos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($moradores as $m): ?>
                <tr>
                    <td><?= $m['id_morador'] ?></td>
                    <td><?= htmlspecialchars($m['nome_morador']) ?></td>
                    <td><?= htmlspecialchars($m['telefone']) ?></td>
                    <td>
                        <a href="?pagina=gerenciar_boletos&id_morador=<?= $m['id_morador'] ?>"
                           style="background:#0288d1;color:white;padding:5px 10px;border-radius:5px;text-decoration:none;">
                           <i class="fa-solid fa-file-invoice-dollar"></i> Ver Boletos
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php
        break;
    }

    // ✅ SEGUNDO PASSO — LISTAR BOLETOS DO MORADOR SELECIONADO
    $idMorador = $_GET["id_morador"];
    $listarBoletoObj = new ListarBoleto($idMorador);
    $boletos = $listarBoletoObj->getBoletos();
    ?>

    <h3><i class="fa-solid fa-file-invoice-dollar"></i> Boletos do Morador #<?= $idMorador ?></h3>

    <a href="?pagina=gerenciar_boletos" style="display:inline-block;margin-bottom:15px;color:#0288d1;">
        ⬅️ Voltar para lista de moradores
    </a>

    <!-- ✅ FORMULÁRIO QUE O MODAL ENVIA AO CONFIRMAR -->
    <form id="formBoletos" method="GET" action="../Boleto.php" style="width:100%;display:contents;">
    
    <input type="hidden" name="acao" value="pagarSindico">
    <input type="hidden" id="id_boleto_input" name="id_boleto">
    <input type="hidden" name="id_morador" value="<?= $idMorador ?>">

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data Emissão</th>
                    <th>Data Vencimento</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Confirmar</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($boletos as $b): ?>
                <tr>
                    <td><?= $b['id_boleto'] ?></td>
                    <td><?= date("d/m/Y", strtotime($b['data_emissao'])) ?></td>
                    <td><?= date("d/m/Y", strtotime($b['data_vencimento'])) ?></td>
                    <td><?= number_format($b['valor'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($b['status_boleto']) ?></td>

                    <td>
                        <?php if (strtolower($b['status_boleto']) == 'aguardando confirmação'): ?>
                            <input
                                type="checkbox"
                                value="<?= $b['id_boleto'] ?>"
                                onchange="
                                    document.getElementById('id_boleto_input').value = this.value;
                                    confirmarPagamento(this);
                                ">
                        <?php else: ?>
                            <input type="checkbox" disabled>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>

<?php
                break;
             case "consumo":
               
                // Listagem 
                break;

            case "correcao":
              
                ?>
                <h3><i class='fa-solid fa-pen-to-square'></i> Solicitar Correção</h3>
                    <form action="../Reclamacao.php?acao=novaReclamacaoSindico" method="POST">
                        
                        <label>Título:</label>
                        <input type="text" name="titulo" required>

                        <label>Descrição:</label>
                        <textarea name="descricao" rows="4" required></textarea>

                        <button type="submit">
                            <i class="fa-solid fa-paper-plane"></i> Enviar Solicitação
                        </button>
                    </form>

                <?php
                break;
                case "reclamacoes":
                
                 include_once(__DIR__ . "/../controle/reclamacaoControle/ListarReclamacaoSindico_class.php");

// Busca as reclamações internas do síndico
$listar = new ListarReclamacaoSindico($_SESSION["id_sindico"]);
$reclamacoes = $listar->getReclamacoes();
?>

<header>
    <h2><i class="fa-solid fa-list-check"></i> Minhas Reclamações Internas</h2>
</header>

<div class="card">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Data</th>
        </tr>
    </thead>

    <tbody>
    <?php if (!empty($reclamacoes)): ?>
        <?php foreach ($reclamacoes as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r['id_reclamacao']) ?></td>
                <td><?= htmlspecialchars($r['titulo']) ?></td>

                <!-- Descrição truncada + tooltip -->
                <td title="<?= htmlspecialchars($r['descricao']) ?>">
                    <?php
                        $desc = trim($r['descricao'] ?? '');
                        if ($desc === '') echo "<i>—</i>";
                        else {
                            $max = 100;
                            echo htmlspecialchars(mb_strlen($desc) > $max 
                                ? mb_substr($desc, 0, $max) . '…'
                                : $desc
                            );
                        }
                    ?>
                </td>

                <td><?= htmlspecialchars($r['status_reclamacao']) ?></td>
                <td><?= date("d/m/Y H:i", strtotime($r['data_reclamacao'])) ?></td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="5" style="text-align:center;">Nenhuma reclamação interna encontrada.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</div>

<?php

                break;

            case "ouvidoria":
                
                 header("Location: form_painel_ouvidoria.php");

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

<!-- Modal de confirmação -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <p>⚠️ Tem certeza que deseja confirmar o pagamento deste boleto?<br>Após confirmar, não será possível reverter a ação.</p>
        <div class="modal-buttons">
            <button id="cancelBtn">Cancelar</button>
            <button id="confirmBtn">Confirmar</button>
        </div>
    </div>
</div>

</body>
</html>
