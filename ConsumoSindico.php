<?php
session_start(); // inicia a sessão

// verifica se o síndico está logado
if (!isset($_SESSION["id_sindico"])) {
     header("Location: ./controle/Logout_class.php");
    exit;
}

// verifica se veio alguma função pela URL
if (isset($_GET["fun"])) {

    $fun = $_GET["fun"];

    // ação de atualizar consumo
    if ($fun == "atualizarConsumo" && isset($_GET["id_consumo"])) {
        include_once(__DIR__ . "/controle/consumoControle/AtualizarConsumo_class.php");

        $obj = new AtualizarConsumo();
        $obj->executar($_GET["id_consumo"]);
        exit;
    }

    // ação de excluir consumo
     if ($fun == "excluirConsumo" && isset($_GET["id_consumo"])) {
        include_once(__DIR__ . "/controle/consumoControle/ExcluirConsumo_class.php");
        $obj = new ExcluirConsumo();
        $obj->excluir($_GET["id_consumo"]);
    }
}
?>
