<?php
session_start(); // inicia a sessão

// verifica se o morador está logado
if (!isset($_SESSION["id_morador"])) {
     header("Location: ./controle/Logout_class.php");
    exit;
}

// verifica se veio alguma ação pela URL
if (isset($_GET["acao"])) {

    $acao = $_GET["acao"];

    // ação de cadastrar nova leitura
    if ($acao == "novaLeitura") {
        	include_once(__DIR__ . "/controle/consumoControle/CadastrarConsumo_class.php");
        $obj = new CadastrarConsumo();
        $obj->novaLeitura($_SESSION["id_morador"]);
    }

   
   
}

?>
