<?php
include_once(__DIR__ . "/../../modelo/reclamacaoModelo/ReclamacaoDao_class.php");

class ListarReclamacaoAguardando {

    private $idSindico;
    private $reclamacoes;

    public function __construct($idSindico) {
        $this->idSindico = $idSindico;
        $dao = new ReclamacaoDao();
        $this->reclamacoes = $dao->listarAguardandoPorSindico($this->idSindico);
    }

    public function getReclamacoes() {
        return $this->reclamacoes;
    }
}
?>
