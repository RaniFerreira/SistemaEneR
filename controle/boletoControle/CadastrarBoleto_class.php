<?php
include_once(__DIR__ . "/../../modelo/boletoModelo/Boleto_class.php");
include_once(__DIR__ . "/../../modelo/boletoModelo/BoletoDao_class.php");

class CadastrarBoleto {

    public function gerarBoleto($idMorador, $valor) {
        $b = new Boleto();
        $b->setIdMorador($idMorador);

        // Define timezone
        date_default_timezone_set('America/Sao_Paulo');

        // Data de emissão = hoje
        $dataEmissao = new DateTime();
        $b->setDataEmissao($dataEmissao->format("Y-m-d"));

        // Data de vencimento = 1 mês depois
        $dataVencimento = (clone $dataEmissao)->modify("+1 month");
        $b->setDataVencimento($dataVencimento->format("Y-m-d"));

        $b->setValor($valor);
        $b->setStatusBoleto("Pendente");

        $dao = new BoletoDao();
        return $dao->cadastrar($b);
    }
}
?>
