<?php
session_start(); // inicia a sessão

// verifica se o morador está logado
if (!isset($_SESSION["id_sindico"])) {
    header("Location: visao/index.php");
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

   

   
}

?>
