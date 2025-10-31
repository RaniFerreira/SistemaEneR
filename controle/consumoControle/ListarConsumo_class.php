<?php
include_once(__DIR__ . "/../../modelo/consumoModelo/ConsumoDao_class.php");

class ListarConsumo {
    private $idMorador;
    private $consumos;

    public function __construct($idMorador) {
        $this->idMorador = $idMorador;

        // Instancia o DAO
        $dao = new ConsumoDao();

        // Pega os consumos do morador e armazena
        $this->consumos = $dao->listarPorMorador($this->idMorador);
    }

    // Retorna a lista de consumos
    public function getConsumos() {
        return $this->consumos;
    }
}
?>
