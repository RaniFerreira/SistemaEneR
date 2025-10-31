<?php
session_start();

if (!isset($_SESSION["id_morador"])) {
    header("Location: visao/index.php");
    exit;
}

if (isset($_GET["acao"]) && $_GET["acao"] === "novaReclamacao") {
    include_once(__DIR__ . "/controle/reclamacaoControle/CadastrarReclamacao_class.php");
    $obj = new CadastrarReclamacao();
    $obj->novaReclamacaoMorador($_SESSION["id_morador"]);
}
?>
