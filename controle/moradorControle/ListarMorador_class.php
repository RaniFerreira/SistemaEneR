<?php
include_once(__DIR__ . "/../../modelo/moradorModelo/MoradorDAO_class.php");

class ListarMorador {
    private $idSindico;
    private $moradores;

    public function __construct($idSindico) {
        $this->idSindico = $idSindico;

        // Instancia o DAO
        $dao = new MoradorDAO();

        // Pega a lista de moradores do síndico e armazena no objeto
        $this->moradores = $dao->listarPorSindico($this->idSindico);
    }

    // Método getter
    public function getMoradores() {
        return $this->moradores;
    }
}
?>
