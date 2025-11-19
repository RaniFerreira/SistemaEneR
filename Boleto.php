<?php
session_start();

// ✅ BLOQUEIA visitantes
if (!isset($_SESSION["id_morador"]) && !isset($_SESSION["id_sindico"])) {
     header("Location: ../controle/Logout_class.php");
    exit;
}

if (isset($_GET["acao"])) {

    $acao = $_GET["acao"];

    // ✅ AÇÃO DO MORADOR
    if ($acao === "pagarMorador" && isset($_SESSION["id_morador"])) {

        include_once(__DIR__ . "/controle/boletoControle/AtualizarBoleto_class.php");
        $obj = new AtualizarBoleto();

        if (isset($_GET["id_boleto"])) {
            $obj->pagarBoleto($_GET["id_boleto"]);
        }

        exit;
    }

    // ✅ AÇÃO DO SÍNDICO
    if ($acao === "pagarSindico" && isset($_SESSION["id_sindico"])) {

        include_once(__DIR__ . "/controle/boletoControle/AtualizarBoletoSindico_class.php");
        $obj = new AtualizarBoletoSindico();

        if (isset($_GET["id_boleto"]) && isset($_GET["id_morador"])) {
            $obj->confirmarPagamento($_GET["id_boleto"], $_GET["id_morador"]);
        }

        exit;
    }
}

?>
