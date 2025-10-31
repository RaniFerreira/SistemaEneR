<?php
include_once(__DIR__ . "/../ConnectionFactory_class.php");
include_once(__DIR__ . "/Boleto_class.php");

class BoletoDao {
    private $con;

    public function __construct() {
        $conF = new ConnectionFactory();
        $this->con = $conF->getConnection();
    }

    // Cadastrar boleto (recebe um objeto)
    public function cadastrar(Boleto $boleto) {
        try {
            $sql = "INSERT INTO boleto (id_morador, data_emissao, data_vencimento, valor, status_boleto)
                    VALUES (:id_morador, :data_emissao, :data_vencimento, :valor, :status_boleto)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id_morador", $boleto->getIdMorador());
            $stmt->bindValue(":data_emissao", $boleto->getDataEmissao());
            $stmt->bindValue(":data_vencimento", $boleto->getDataVencimento());
            $stmt->bindValue(":valor", $boleto->getValor());
            $stmt->bindValue(":status_boleto", $boleto->getStatusBoleto());
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar boleto: " . $e->getMessage());
            return false;
        }
    }

    // Listar boletos de um morador específico
    public function listarPorMorador($idMorador) {
        try {
            $sql = "SELECT * FROM boleto WHERE id_morador = :id_morador ORDER BY data_emissao DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id_morador", $idMorador);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar boletos: " . $e->getMessage());
            return [];
        }
    }

    // 🟢 Atualizar o status de um boleto
    public function atualizarStatus($idBoleto, $novoStatus) {
        try {
            $sql = "UPDATE boleto SET status_boleto = :status WHERE id_boleto = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":status", $novoStatus);
            $stmt->bindValue(":id", $idBoleto);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar status do boleto: " . $e->getMessage());
            return false;
        }
    }
}
?>
