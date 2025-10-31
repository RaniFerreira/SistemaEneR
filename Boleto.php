<?php
session_start(); // inicia a sessão

// Verifica se o morador está logado
if (!isset($_SESSION["id_morador"])) {
    header("Location: visao/index.php");
    exit;
}

// Verifica se veio alguma ação pela URL
if (isset($_GET["acao"])) {

    $acao = $_GET["acao"];

    // 🔹 Ação de pagar boleto
    if ($acao == "pagar") {
        include_once(__DIR__ . "/controle/boletoControle/AtualizarBoleto_class.php");
        $obj = new CadastrarBoleto();

        if (isset($_GET["id_boleto"])) {
            $idBoleto = $_GET["id_boleto"];
            $obj->pagarBoleto($idBoleto);
        }

       
    }

    
    
}
?>
