<?php
include_once(__DIR__ . "/../../modelo/boletoModelo/BoletoDao_class.php");

class CadastrarBoleto {

    // Atualiza o status do boleto para "Aguardando Confirmação"
    public function pagarBoleto($idBoleto) {
        $dao = new BoletoDao();
        $dao->atualizarStatus($idBoleto, "Aguardando Confirmação");

         // Redireciona de volta para o painel do morador ou listagem de boletos
        header("Location: visao/form_painel_morardor.php?pagina=boletos");
            exit;
    }
}
?>
