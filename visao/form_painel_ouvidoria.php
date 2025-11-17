<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id_sindico"])) {
    header("Location: controle/Logout_class.php");
    exit;
}

$pagina = $_GET["pagina"] ?? "home";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel da Ouvidoria</title>

    <link rel="stylesheet" href="/sistemaEneR/visao/css/estilo_painel_sindico.css">
    <script src="https://kit.fontawesome.com/a2e0e9a09f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div>
        <div class="sidebar-header">
            <h2><i class="fa-solid fa-user-tie"></i> Ouvidoria</h2>
            <p style="text-align:center;"><?= $_SESSION["nome_usuario"] ?></p>
        </div>

        <div class="menu">
            <a href="?pagina=home"><i class="fa-solid fa-house"></i> Voltar ao painel</a>
            <a href="?pagina=listarReclamacoes"><i class="fa-solid fa-eye"></i>Reclamações</a>
            <a href="?pagina=correcaoAprovada"><i class="fa-solid fa-check"></i>Aprovadas</a>
            <a href="?pagina=correcaoReprovada"><i class="fa-solid fa-xmark"></i>Reprovadas</a>
        </div>
    </div>

    <a href="../controle/Logout_class.php" class="logout">
        <i class="fa-solid fa-right-from-bracket"></i> Sair
    </a>
</div>

<!-- CONTEÚDO -->
<div class="main-content">

<?php
switch($pagina)
{

/* ============================
   ✅ CASE - HOME (vazio)
============================= */
case "home":
?>
<header>
    <h2><i class="fa-solid fa-comments"></i> Painel da Ouvidoria</h2>
</header>
<div class="card">

    <div style="text-align: center; margin-top: 100px;">

    <h2 style="color: #0288d1; font-family: Arial, sans-serif;">
        👋 Bem-vindo(a) à Ouvidoria, <?= htmlspecialchars($_SESSION["nome_usuario"]) ?>!
    </h2>

    <p style="font-size: 18px; color: #555; max-width: 600px; margin: 0 auto; line-height: 1.6;">
        Aqui você acompanha reclamações, solicitações e correções relacionadas ao condomínio.
        Utilize o menu ao lado para visualizar as opções disponíveis e acessar as áreas da Ouvidoria.
    </p>

    <div style="font-size: 50px; color: #0288d1; margin-top: 20px;">
         ⬅️
    </div>

    <p style="color: #888; font-size: 14px;">
        Clique em uma das opções ao lado para começar.
    </p>

    <!-- BOTÃO VOLTAR AO PAINEL DO SÍNDICO -->
    <a href="form_painel_sindico.php" class="btn-menu" 
       style="margin-top: 20px; display: inline-block; text-decoration: none;">
        <i class="fa-solid fa-house"></i> Voltar ao Painel do Síndico
    </a>

</div>

</div>


<?php
break;

/* ============================
   ✅ CASE - LISTAR RECLAMAÇÕES (vazio)
============================= */
case "listarReclamacoes":

require_once(__DIR__ . "/../controle/reclamacaoControle/ListarReclamacaoAguardando_class.php");
$list = new ListarReclamacaoAguardando($_SESSION["id_sindico"]);
$reclamacoes = $list->getReclamacoes();
?>
<header>
    <h2><i class="fa-solid fa-hourglass-half"></i> Reclamações Aguardando Análise</h2>
</header>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Morador</th>
                <th>Status</th>
                <th>Data</th>
                <th>Descrição</th> 
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
        <?php if (empty($reclamacoes)): ?>
            <tr>
                <!-- atualizei colspan para 6 -->
                <td colspan="6" style="text-align:center;color:#777;">
                    Nenhuma reclamação aguardando análise.
                </td>
            </tr>
        <?php else: foreach ($reclamacoes as $r): ?>
            <tr>
                <td><?= $r['id_reclamacao'] ?></td>
                <td><?= htmlspecialchars($r['titulo']) ?></td>
                <td><?= $r['nome_morador'] ?: "<i>Interna</i>" ?></td>

                <td><span class="status-badge analise"><?= htmlspecialchars($r['status_reclamacao']) ?></span></td>

                <td><?= date("d/m/Y H:i", strtotime($r['data_reclamacao'])) ?></td>

                <!-- descrição: mostra texto truncado com tooltip para o texto completo -->
                <td title="<?= htmlspecialchars($r['descricao']) ?>">
                    <?php
                        $desc = trim($r['descricao'] ?? '');
                        if ($desc === '') {
                            echo "<i>—</i>";
                        } else {
                            // trunca em 100 caracteres sem quebrar múltibyte
                            $max = 100;
                            if (mb_strlen($desc) > $max) {
                                echo htmlspecialchars(mb_substr($desc, 0, $max)) . '…';
                            } else {
                                echo htmlspecialchars($desc);
                            }
                        }
                    ?>
                </td>
                <td>
                    <button class="btn-editar" 
                        onclick="abrirModalReclamacao(
        '<?= $r['id_reclamacao'] ?>',
        '<?= htmlspecialchars(addslashes($r['titulo'])) ?>',
        '<?= htmlspecialchars(addslashes($r['descricao'])) ?>',
        '<?= htmlspecialchars(addslashes($r['resposta'] ?? '')) ?>',
        '<?= $r['status_reclamacao'] ?>'
    )">
                        
                        <i class="fa-solid fa-pen-to-square"></i> Responder
                    </button>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
    <!-- Inclui o modal de resposta de reclamação -->
    <?php include(__DIR__ . "/../visao/form_modal_resposta_reclamacao.php"); ?>
    <link rel="stylesheet" href="../visao/css/estilo_modal_resposta_reclamacao.css">
    <script src="../visao/js/modalRespostaReclamacao.js"></script>


<?php
break;

/* ============================
   ✅ CASE - CORREÇÕES APROVADAS (vazio)
============================= */
case "correcaoAprovada":


require_once(__DIR__ . "/../controle/reclamacaoControle/ListarReclamacaoAprovada_class.php");
$list = new ListarReclamacaoAprovada($_SESSION["id_sindico"]);
$reclamacoes = $list->getReclamacoes();
?>
<header>
    <h2><i class="fa-solid fa-check"></i> Reclamações Aprovadas</h2>
</header>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Morador</th>
                <th>Status</th>
                <th>Data</th>
                <th>Descrição</th>
            </tr>
        </thead>

        <tbody>
        <?php if (empty($reclamacoes)): ?>
            <tr>
                <td colspan="6" style="text-align:center;color:#777;">
                    Nenhuma reclamação aprovada.
                </td>
            </tr>
        <?php else: foreach ($reclamacoes as $r): ?>
            <tr>
                <td><?= $r['id_reclamacao'] ?></td>
                <td><?= htmlspecialchars($r['titulo']) ?></td>
                <td><?= $r['nome_morador'] ?: "<i>Interna</i>" ?></td>

                <td><span class="status-badge aprovado"><?= htmlspecialchars($r['status_reclamacao']) ?></span></td>

                <td><?= date("d/m/Y H:i", strtotime($r['data_reclamacao'])) ?></td>

                <td title="<?= htmlspecialchars($r['descricao']) ?>">
                    <?php
                        $desc = trim($r['descricao'] ?? '');
                        if ($desc === '') {
                            echo "<i>—</i>";
                        } else {
                            $max = 100;
                            if (mb_strlen($desc) > $max) {
                                echo htmlspecialchars(mb_substr($desc, 0, $max)) . '…';
                            } else {
                                echo htmlspecialchars($desc);
                            }
                        }
                    ?>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>

<?php
break;

/* ============================
   ✅ CASE - CORREÇÕES REPROVADAS (vazio)
============================= */
case "correcaoReprovada":

require_once(__DIR__ . "/../controle/reclamacaoControle/ListarReclamacaoReprovada_class.php");
$list = new ListarReclamacaoReprovada($_SESSION["id_sindico"]);
$reclamacoes = $list->getReclamacoes();
?>
<header>
    <h2><i class="fa-solid fa-xmark"></i> Reclamações Reprovadas</h2>
</header>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Morador</th>
                <th>Status</th>
                <th>Data</th>
                <th>Descrição</th>
            </tr>
        </thead>

        <tbody>
        <?php if (empty($reclamacoes)): ?>
            <tr>
                <td colspan="6" style="text-align:center;color:#777;">
                    Nenhuma reclamação reprovada.
                </td>
            </tr>
        <?php else: foreach ($reclamacoes as $r): ?>
            <tr>
                <td><?= $r['id_reclamacao'] ?></td>
                <td><?= htmlspecialchars($r['titulo']) ?></td>
                <td><?= $r['nome_morador'] ?: "<i>Interna</i>" ?></td>

                <td><span class="status-badge reprovada"><?= htmlspecialchars($r['status_reclamacao']) ?></span></td>

                <td><?= date("d/m/Y H:i", strtotime($r['data_reclamacao'])) ?></td>

                <td title="<?= htmlspecialchars($r['descricao']) ?>">
                    <?php
                        $desc = trim($r['descricao'] ?? '');
                        if ($desc === '') {
                            echo "<i>—</i>";
                        } else {
                            $max = 100;
                            if (mb_strlen($desc) > $max) {
                                echo htmlspecialchars(mb_substr($desc, 0, $max)) . '…';
                            } else {
                                echo htmlspecialchars($desc);
                            }
                        }
                    ?>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>

<?php
break;

} // fim do switch
?>

</div>
</body>
</html>
