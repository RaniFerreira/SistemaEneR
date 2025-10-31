<?php
include_once(__DIR__ . "/../ConnectionFactory_class.php");
include_once(__DIR__ . "/Sindico_class.php"); // se estiver na mesma pasta

class SindicoDAO {
    private $con = null;

    public function __construct() { $cf = new ConnectionFactory();
       $cf = new ConnectionFactory();  // cria a instância da factory
        $this->con = $cf->getConnection(); // pega a conexão e atribui à variável da classe
    }

    // Cadastrar síndico
    public function cadastrar($sindico) {
        try {
            $stmt = $this->con->prepare("
                INSERT INTO sindico (id_usuario, nome, nome_condominio, telefone)
                VALUES (:id_usuario, :nome, :nome_condominio, :telefone)
            ");
            $stmt->bindValue(":id_usuario", $sindico->getIdUsuario());
            $stmt->bindValue(":nome", $sindico->getNome());
            $stmt->bindValue(":nome_condominio", $sindico->getNomeCondominio());
            $stmt->bindValue(":telefone", $sindico->getTelefone());
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar síndico: " . $e->getMessage();
        }
    }

    

}
?>
