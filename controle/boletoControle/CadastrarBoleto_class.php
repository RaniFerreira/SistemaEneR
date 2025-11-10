<?php
include_once(__DIR__ . "/../../modelo/boletoModelo/Boleto_class.php");
include_once(__DIR__ . "/../../modelo/boletoModelo/BoletoDao_class.php");

class CadastrarBoleto {

    public function gerarBoleto($idMorador, $valor, $idConsumo) {

        $b = new Boleto();

        // Armazena morador e consumo
        $b->setIdMorador($idMorador);
        $b->setIdConsumo($idConsumo);

        // Timezone
        date_default_timezone_set('America/Sao_Paulo');

        // Data emissão hoje
        $dataEmissao = new DateTime();
        $b->setDataEmissao($dataEmissao->format("Y-m-d"));

        // Vencimento = 30 dias depois
        $dataVencimento = (clone $dataEmissao)->modify("+30 days");
        $b->setDataVencimento($dataVencimento->format("Y-m-d"));

        // Valor e status
        $b->setValor($valor);
        $b->setStatusBoleto("Pendente");

        // DAO
        $dao = new BoletoDao();
        return $dao->cadastrar($b); // retorna true ou false
    }
}
?>
