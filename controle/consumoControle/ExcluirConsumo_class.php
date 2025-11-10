<?php
include_once(__DIR__ . "/../../modelo/consumoModelo/ConsumoDAO_class.php");
include_once(__DIR__ . "/../../modelo/boletoModelo/BoletoDAO_class.php");

class ExcluirConsumo {

    public function excluir($idConsumo) {
        $consumoDAO = new ConsumoDAO();
        $boletoDAO = new BoletoDAO();

        // Exclui boleto vinculado ao consumo (se existir)
        $boletoDAO->excluirBoletoPorConsumo($idConsumo);

        // Exclui o consumo
        $consumoDAO->excluirConsumo($idConsumo);

        // Redireciona de volta para a listagem do morador
        $idMorador = $_GET['id_morador'] ?? '';
        header("Location: visao/form_painel_sindico.php?pagina=consumo&id_morador=$idMorador");
        exit;
    }
}
?>
