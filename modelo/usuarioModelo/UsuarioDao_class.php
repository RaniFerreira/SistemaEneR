<?php
include_once(__DIR__ . "/../ConnectionFactory_class.php");
include_once(__DIR__ . "/Usuario_class.php"); // se estiver na mesma pasta


class UsuarioDAO {
    private $con = null;

    public function __construct() {
        $cf = new ConnectionFactory();
        $this->con = $cf->getConnection();
    }
    public function emailExiste($email) {
    try {
        $stmt = $this->con->prepare("SELECT COUNT(*) FROM usuario WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        echo "Erro ao verificar email: " . $e->getMessage();
        return false;
    }
}


    public function cadastrar($usuario) {
        try {
            $stmt = $this->con->prepare("
                INSERT INTO usuario (nome_usuario, email, senha)
                VALUES (:nome, :email, :senha)
            ");
            $stmt->bindValue(":nome", $usuario->getNomeUsuario());
            $stmt->bindValue(":email", $usuario->getEmail());
            $stmt->bindValue(":senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
            $stmt->execute();

            // Retorna o ID do usuário recém-cadastrado
            return $this->con->lastInsertId();

        } catch (PDOException $e) {
            echo "Erro ao cadastrar usuário: " . $e->getMessage();
        }
    }

}
?>
