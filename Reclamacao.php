<?php
session_start();

// Se não for morador e nem síndico, bloqueia
if (!isset($_SESSION["id_morador"]) && !isset($_SESSION["id_sindico"])) {
    header("Location: visao/index.php");
    exit;
}

if (isset($_GET["acao"])) {

    include_once(__DIR__ . "/controle/reclamacaoControle/CadastrarReclamacao_class.php");
    $obj = new CadastrarReclamacao();

    // ✅ AÇÃO: Morador enviando reclamação
    if ($_GET["acao"] === "novaReclamacaoMorador" && isset($_SESSION["id_morador"])) {
        $obj->novaReclamacaoMorador($_SESSION["id_morador"]);
        exit;
    }

    // ✅ AÇÃO: Síndico enviando reclamação interna
    if ($_GET["acao"] === "novaReclamacaoSindico" && isset($_SESSION["id_sindico"])) {
        $obj->novaReclamacaoSindico($_SESSION["id_sindico"]);
        exit;
    }

    // ✅ AÇÃO: Síndico respondendo / editando reclamação
    if ($_GET["acao"] === "editarOuvidoria" && isset($_SESSION["id_sindico"])) {
        include_once(__DIR__ . "/controle/reclamacaoControle/AtualizarReclamacao_class.php");
        $editar = new  AtualizarReclamacaoOuvidoria();
        $editar->AtualizarReclamacao($_SESSION["id_sindico"]);
        exit;
    }
}
?>
