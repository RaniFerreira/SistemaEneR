<?php
include_once(__DIR__ . "/../../modelo/consumoModelo/ConsumoDao_class.php");

class ListarConsumo {

    private $idMorador;
    private $consumos;

    public function __construct($idMorador) {
        $this->idMorador = $idMorador;

        $dao = new ConsumoDao();
        $this->consumos = $dao->listarPorMorador($this->idMorador);
    }

    public function getConsumos() {
        return $this->consumos;
    }
}
?>
