<?php
include_once(__DIR__ . "/../../modelo/boletoModelo/BoletoDao_class.php");

class AtualizarBoletoSindico {

    public function confirmarPagamento($idBoleto, $idMorador) {

        $dao = new BoletoDao();
        $dao->atualizarStatus($idBoleto, "Pago");

       header("Location: visao/form_painel_sindico.php?pagina=gerenciar_boletos");
        exit;

    }
}
?>
