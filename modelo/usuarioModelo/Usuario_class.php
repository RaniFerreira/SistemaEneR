<?php
class Usuario {
    private $id_usuario;
    private $nome_usuario;
    private $email;
    private $senha;

    public function __construct() {}

    public function getIdUsuario() {
        return $this->id_usuario;
    }
    public function setIdUsuario($id) {
        $this->id_usuario = $id;
    }

    public function getNomeUsuario() {
        return $this->nome_usuario;
    }
    public function setNomeUsuario($nome) {
        $this->nome_usuario = $nome;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
    }
}
?>
