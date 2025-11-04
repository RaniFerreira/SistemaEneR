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
public function atualizar($usuario) {
    try {
        // Verifica se há uma nova senha informada
        if (!empty($usuario->getSenha())) {
            // Atualiza tudo, incluindo a senha
            $stmt = $this->con->prepare("
                UPDATE usuario
                SET nome_usuario = :nome_usuario,
                    email = :email,
                    senha = :senha
                WHERE id_usuario = :id_usuario
            ");
            $stmt->bindValue(":senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
        } else {
            // Atualiza somente nome e email
            $stmt = $this->con->prepare("
                UPDATE usuario
                SET nome_usuario = :nome_usuario,
                    email = :email
                WHERE id_usuario = :id_usuario
            ");
        }

        $stmt->bindValue(":nome_usuario", $usuario->getNomeUsuario());
        $stmt->bindValue(":email", $usuario->getEmail());
        $stmt->bindValue(":id_usuario", $usuario->getIdUsuario());
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao atualizar usuário: " . $e->getMessage();
    }
}
public function buscarUsuarioPorMorador($idMorador) {
    try {
        $stmt = $this->con->prepare("
            SELECT u.id_usuario 
            FROM usuario u
            INNER JOIN morador m ON u.id_usuario = m.id_usuario
            WHERE m.id_morador = :id_morador
        ");
        $stmt->bindValue(":id_morador", $idMorador, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao buscar usuário do morador: " . $e->getMessage();
        return false;
    }
}

public function excluirUsuario($idUsuario) {
    try {
        $stmt = $this->con->prepare("
            DELETE FROM usuario WHERE id_usuario = :id_usuario
        ");
        $stmt->bindValue(":id_usuario", $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao excluir usuário: " . $e->getMessage();
    }
}



}
?>
