<?php
include_once(__DIR__ . "/../ConnectionFactory_class.php");
include_once(__DIR__ . "/Reclamacao_class.php");
class ReclamacaoDao {
    private $con;

    public function __construct() {
        $conF = new ConnectionFactory();
        $this->con = $conF->getConnection();
    }


      // Cadastrar reclamação (morador ou síndico)
    public function cadastrar(Reclamacao $r) {
        try {
            $sql = "INSERT INTO reclamacao 
                    (id_morador, id_sindico, titulo, descricao, data_reclamacao, status_reclamacao)
                    VALUES (:id_morador, :id_sindico, :titulo, :descricao, :data_reclamacao, :status_reclamacao)";
            $stmt = $this->con->prepare($sql);

            $stmt->bindValue(":id_morador", $r->getIdMorador() ?? null, PDO::PARAM_INT);
            $stmt->bindValue(":id_sindico", $r->getIdSindico() ?? null, PDO::PARAM_INT);
            $stmt->bindValue(":titulo", $r->getTitulo());
            $stmt->bindValue(":descricao", $r->getDescricao());
            $stmt->bindValue(":data_reclamacao", $r->getDataReclamacao() ?? date("Y-m-d")); // se não setada, pega data atual
            $stmt->bindValue(":status_reclamacao", $r->getStatusReclamacao() ?? "Pendente");

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar reclamação: " . $e->getMessage());
            return false;
        }
    }

    // Listar reclamações do morador
    public function listarPorMorador($idMorador) {
        try {
            $sql = "SELECT * FROM reclamacao WHERE id_morador = :id_morador ORDER BY data_reclamacao DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id_morador", $idMorador);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar reclamações: " . $e->getMessage());
            return [];
        }
    }

    // Listar reclamações do síndico
    public function listarPorSindico($idSindico) {
        try {
            $sql = "SELECT * FROM reclamacao WHERE id_sindico = :id_sindico ORDER BY data_reclamacao DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id_sindico", $idSindico);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar reclamações: " . $e->getMessage());
            return [];
        }
    }
}
?>
