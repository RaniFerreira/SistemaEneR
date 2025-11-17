<?php
session_start(); // inicia a sessão

// verifica se o morador está logado
if (!isset($_SESSION["id_sindico"])) {
     header("Location: ./controle/Logout_class.php");
    exit;
}

// verifica se veio alguma ação pela URL
if (isset($_GET["fun"])) {

    $acao = $_GET["fun"];

    // ação de cadastrar nova leitura
    if ($acao == "cadastrarMorador") {
        	include_once(__DIR__ . "/controle/moradorControle/CadastrarMorador_class.php");
        $obj = new CadastrarMorador();
        $obj->cadastrar($_SESSION["id_sindico"]);
    }
        // ação de atualizar morador
    else if ($acao == "atualizarMorador") {
        include_once(__DIR__ . "/controle/moradorControle/AtualizarMorador_class.php");
        $obj = new AtualizarMorador();
        $obj->atualizar($_GET["id"]);
    }
    
    else if ($acao == "listarMoradorParteConsumo") {
        include_once(__DIR__ . "/controle/moradorControle/listarMorador_class.php");
         $listarMoradorObj = new ListarMorador($_SESSION["id_sindico"]);
        $moradores = $listarMoradorObj->getMoradores();
        header("Location: visao/form_painel_sindico.php?pagina=consumo");
        exit;
    }
    else if ($acao == "listarMoradorParteBoleto") {
        include_once(__DIR__ . "/controle/moradorControle/listarMorador_class.php");
         $listarMoradorObj = new ListarMorador($_SESSION["id_sindico"]);
        $moradores = $listarMoradorObj->getMoradores();
        header("Location: visao/form_painel_sindico.php?pagina=gerenciar_boletos");
        exit;
    }
    else if ($acao == "excluirMorador") {
    include_once(__DIR__ . "/controle/moradorControle/ExcluirMorador_class.php");
    $obj = new ExcluirMorador();
    if (isset($_GET["id"])) {
        $obj->excluir($_GET["id"]);
    }
}


   

   
}

?>
