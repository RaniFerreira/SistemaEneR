<?php
include_once(__DIR__ . "/../../modelo/reclamacaoModelo/ReclamacaoDao_class.php");

class ListarReclamacaoReprovada {

    private $idSindico;
    private $reclamacoes;

    public function __construct($idSindico) {
        $this->idSindico = $idSindico;
        $dao = new ReclamacaoDao();
        $this->reclamacoes = $dao->listarReprovadasPorSindico($this->idSindico);
    }

    public function getReclamacoes() {
        return $this->reclamacoes;
    }
}
?>
