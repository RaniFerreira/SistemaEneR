<?php
include_once(__DIR__ . "/../../modelo/boletoModelo/BoletoDao_class.php");

class ListarBoleto {
    private $idMorador;
    private $boletos;

    public function __construct($idMorador) {
        $this->idMorador = $idMorador;

        // Instancia o DAO
        $dao = new BoletoDao();

        // Pega a lista de boletos do morador e armazena no objeto
        $this->boletos = $dao->listarPorMorador($this->idMorador);
    }

    // Método getter
    public function getBoletos() {
        return $this->boletos;
    }
}
?>
