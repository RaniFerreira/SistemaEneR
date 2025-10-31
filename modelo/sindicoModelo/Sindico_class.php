<?php
class Sindico {
    private $id_sindico;
    private $id_usuario;
    private $nome;
    private $nome_condominio;
    private $telefone;

    public function __construct() {}

    public function getIdSindico() {
        return $this->id_sindico;
    }
    public function setIdSindico($id) {
        $this->id_sindico = $id;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNomeCondominio() {
        return $this->nome_condominio;
    }
    public function setNomeCondominio($condominio) {
        $this->nome_condominio = $condominio;
    }

    public function getTelefone() {
        return $this->telefone;
    }
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
}
?>
