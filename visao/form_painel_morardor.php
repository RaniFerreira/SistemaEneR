<?php
// Inicia sessão apenas se ainda não tiver sido iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se usuário está logado
if (!isset($_SESSION["id_morador"])) {
    header("Location: index.php");
    exit;
}

// Roteador: define qual página mostrar
$pagina = $_GET["pagina"] ?? "home";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Morador</title>
    <link rel="stylesheet" href="/sistemaEneR/visao/css/estilo_painel_morador.css">
    <link rel="stylesheet" href="/sistemaEneR/visao/css/estilo_tela_confirma_pag.css">
    <link rel="stylesheet" href="../visao/css/estilo_modal_boleto_informativo.css">
    <script src="https://kit.fontawesome.com/a2e0e9a09f.js" crossorigin="anonymous"></script>
    <script src="/sistemaEneR/visao/js/calculaConsumo.js"></script>
    <script src="/sistemaEneR/visao/js/confirmacaoPagamento.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    
</head>
<body>

<div class="sidebar">
    <div>
        <div class="sidebar-header">
            <h2><i class="fa-solid fa-user"></i> Morador</h2>
            <p style="text-align:center;"><?= $_SESSION["nome_usuario"] ?></p>
        </div>

        <div class="menu">
            
            <a href="?pagina=leitura"><i class="fa-solid fa-bolt"></i> Inserir Leitura</a>
            <a href="?pagina=boletos"><i class="fa-solid fa-file-invoice-dollar"></i> Visualizar Boletos</a>
            <a href="?pagina=correcao"><i class="fa-solid fa-pen-to-square"></i> Solicitar Correção</a>
            <a href="?pagina=reclamacoes"><i class="fa-solid fa-list-check"></i> Listar Reclamações</a>
        </div>
    </div>

    <a href="../controle/Logout_class.php" class="logout">
        <i class="fa-solid fa-right-from-bracket"></i> Sair
    </a>
</div>

<div class="main-content">
    <header>
        <h2><i class="fa-solid fa-house"></i> Painel do(a) Morador(a)</h2>
    </header>

    <div class="card">
    <?php
    
    // Conteúdo dinâmico da página
    switch($pagina){
        case "leitura":
            $tarifa = 0.99; // valor da tarifa fixa
            ?>

            <h3><i class='fa-solid fa-bolt'></i> Inserir Leitura de Consumo</h3>
            <?php if (isset($status)) { ?>
           
        <?php } ?>

            <form   action="../Consumo.php?acao=novaLeitura"  method="POST">
                <label for='kwh'>kWh consumidos:</label>
                <input type='number' step='0.01' name='kwh' id="kwhInput" data-tarifa="<?= $tarifa ?>" required>
             

                <button type='submit'><i class='fa-solid fa-floppy-disk'></i> Registrar Leitura</button>
                <br>
                <br>
                <p id="resumoConsumo" style="color: blue; font-weight: bold; white-space: pre-line;">
                    Valor estimado: R$ 0,00
                </p>
            </form>
            
                        <!-- Referência ao JS externo -->
            <script src="/js/calculaConsumo.js"></script>


        
            <?php
        break;

        case "boletos":
        // Inclui a classe de listagem de boletos
        include_once(__DIR__ . "/../controle/boletoControle/ListarBoleto_class.php");

        // Cria o objeto e pega os boletos do morador logado
        $listarBoletoObj = new ListarBoleto($_SESSION["id_morador"]);
        $boletos = $listarBoletoObj->getBoletos();
        ?>
        
        <h3><i class='fa-solid fa-file-invoice-dollar'></i> Visualizar Boletos</h3>
        
       <form class="form_visu_boleto" id="formBoletos" method="GET" action="../Boleto.php" style="width:100%; display:contents;">
    
    <input type="hidden" name="acao" value="pagarMorador">
    <input type="hidden" id="id_boleto_input" name="id_boleto">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data Emissão</th>
                <th>Data Vencimento</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Pagar</th>
                <th>Ver</th> 
            </tr>
        </thead>
        <tbody>
            <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                include_once(__DIR__ . "/../controle/boletoControle/VisualizarBoleto_class.php");
             
                ?>
            <?php foreach ($boletos as $b): ?>
                 <?php
                            // 2️⃣ Busca os dados completos de cada boleto
                            $visualizar = new VisualizarBoleto($b['id_boleto']);
                            $dadosBoleto = $visualizar->getDadosCompleto();
                    ?>
                
                <tr>
                    <td><?= htmlspecialchars($b['id_boleto']) ?></td>
                    <td><?= date("d/m/Y", strtotime($b['data_emissao'])) ?></td>
                    <td><?= date("d/m/Y", strtotime($b['data_vencimento'])) ?></td>
                    <td><?= number_format($b['valor'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($b['status_boleto']) ?></td>
                    <td>
                        <?php if (strtolower($b['status_boleto']) == 'pendente'): ?>
                            <!-- Checkbox com evento para enviar automaticamente -->
                            <input 
                                type="checkbox" 
                                name="id_boleto" 
                                value="<?= $b['id_boleto'] ?>" 
                                onchange="confirmarPagamento(this)">
                        <?php else: ?>
                            <input type="checkbox" disabled>
                        <?php endif; ?>
                    </td>
                    <td style="text-align:center;">
                        <i class="fa-solid fa-file-invoice-dollar"
               onclick="abrirModalBoleto(this)"
               data-morador="<?= htmlspecialchars($dadosBoleto['morador_nome']) ?>"
               data-condominio="<?= htmlspecialchars($dadosBoleto['morador_condominio']) ?>"
               data-emissao="<?= date("d/m/Y", strtotime($dadosBoleto['data_emissao'])) ?>"
               data-vencimento="<?= date("d/m/Y", strtotime($dadosBoleto['data_vencimento'])) ?>"
               data-valor="<?= number_format($dadosBoleto['valor'], 2, ',', '.') ?>"
               data-status="<?= htmlspecialchars($dadosBoleto['status_boleto']) ?>"
               data-kwh="<?= htmlspecialchars($dadosBoleto['consumo_kwh']) ?>">
            </i>
                    </td>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>
<script>
// Quando o checkbox é marcado, envia o formulário automaticamente
function pagarBoleto(checkbox) {
    if (checkbox.checked) {
        document.getElementById('formBoletos').submit();
    }
}
</script>
<!-- Inclui o CSS do modal -->

<!-- Inclui o modal de boleto -->
<?php include(__DIR__ . "/../visao/form_modal_boleto_informativo.php"); ?>


<!-- Inclui o JS do modal -->
<script src="../visao/js/modalBoletoInformativo.js"></script>



<?php
break;


      case "correcao":
        ?>
            <h3><i class='fa-solid fa-pen-to-square'></i> Solicitar Correção</h3>
            <form action='../Reclamacao.php?acao=novaReclamacaoMorador' method='POST'>
                <label>Título:</label>
                <input type='text' name='titulo' required>
                
                <label>Descrição:</label>
                <textarea name='descricao' rows='4' required></textarea>
                
                <button type='submit'>
                    <i class='fa-solid fa-paper-plane'></i> Enviar Solicitação
                </button>
            </form>
        <?php
break;

        case "reclamacoes":
            include_once(__DIR__ . "/../controle/reclamacaoControle/ListarReclamacao_class.php");

                    // Cria o objeto e pega as reclamações do morador logado
                    $listarReclamacaoObj = new ListarReclamacao($_SESSION["id_morador"]);
                    $reclamacoes = $listarReclamacaoObj->getReclamacoes();
                    ?>
                    
                    <h3><i class='fa-solid fa-list-check'></i>Reclamações</h3>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Status</th>
                                <th>Resposta</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($reclamacoes)): ?>
                                <?php foreach ($reclamacoes as $r): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($r['id_reclamacao']) ?></td>
                                        <td><?= htmlspecialchars($r['titulo']) ?></td>
                                        <td><?= htmlspecialchars($r['descricao']) ?></td>
                                        <td><?= htmlspecialchars($r['status_reclamacao']) ?></td>
                                        <td><?= htmlspecialchars($r['resposta']) ?></td>
                                        <td><?= date("d/m/Y ", strtotime($r['data_reclamacao'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;">Nenhuma reclamação encontrada.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php
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
        break;
    }
    ?>
    </div>
</div>

<!-- Modal de confirmação -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <p>⚠️ Tem certeza que deseja pagar este boleto?<br>Após confirmar, não será possível reverter a ação.</p>
        <div class="modal-buttons">
            <button id="cancelBtn">Cancelar</button>
            <button id="confirmBtn">Confirmar</button>
        </div>
    </div>
</div>


</body>
</html>
