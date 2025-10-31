<?php
include_once(__DIR__ . "/../../modelo/reclamacaoModelo/ReclamacaoDao_class.php");

class ListarReclamacao {
    private $idMorador;
    private $reclamacoes;

    public function __construct($idMorador) {
        $this->idMorador = $idMorador;
        $dao = new ReclamacaoDao();
        $this->reclamacoes = $dao->listarPorMorador($this->idMorador);
    }

    public function getReclamacoes() {
        return $this->reclamacoes;
    }
}
?>
