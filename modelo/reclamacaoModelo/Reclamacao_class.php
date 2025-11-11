<?php
class Reclamacao {
    private $id_reclamacao;
    private $id_morador;
    private $id_sindico;
    private $titulo;
    private $descricao;
    private $resposta; // 👈 novo atributo
    private $data_reclamacao;
    private $status_reclamacao;

    // Getters e Setters
    public function getIdReclamacao() {
        return $this->id_reclamacao;
    }
    public function setIdReclamacao($id_reclamacao) {
        $this->id_reclamacao = $id_reclamacao;
    }

    public function getIdMorador() {
        return $this->id_morador;
    }
    public function setIdMorador($id_morador) {
        $this->id_morador = $id_morador;
    }

    public function getIdSindico() {
        return $this->id_sindico;
    }
    public function setIdSindico($id_sindico) {
        $this->id_sindico = $id_sindico;
    }

    public function getTitulo() {
        return $this->titulo;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getResposta() {
        return $this->resposta;
    }
    public function setResposta($resposta) {
        $this->resposta = $resposta;
    }

    public function getDataReclamacao() {
        return $this->data_reclamacao;
    }
    public function setDataReclamacao($data_reclamacao) {
        $this->data_reclamacao = $data_reclamacao;
    }

    public function getStatusReclamacao() {
        return $this->status_reclamacao;
    }
    public function setStatusReclamacao($status_reclamacao) {
        $this->status_reclamacao = $status_reclamacao;
    }
}
?>
