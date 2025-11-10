<?php
include_once(__DIR__ . "/../ConnectionFactory_class.php");
include_once(__DIR__ . "/Boleto_class.php");

class BoletoDao {
    private $con;

    public function __construct() {
        $conF = new ConnectionFactory();
        $this->con = $conF->getConnection();
    }

     public function cadastrar(Boleto $boleto) {
        try {
            $sql = "INSERT INTO boleto 
                    (id_morador, id_consumo, data_emissao, data_vencimento, valor, status_boleto)
                    VALUES (:id_morador, :id_consumo, :data_emissao, :data_vencimento, :valor, :status_boleto)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id_morador", $boleto->getIdMorador());
            $stmt->bindValue(":id_consumo", $boleto->getIdConsumo());
            $stmt->bindValue(":data_emissao", $boleto->getDataEmissao());
            $stmt->bindValue(":data_vencimento", $boleto->getDataVencimento());
            $stmt->bindValue(":valor", $boleto->getValor());
            $stmt->bindValue(":status_boleto", $boleto->getStatusBoleto());

            if ($stmt->execute()) {
                return true; // sucesso
            } else {
                error_log("Erro ao cadastrar boleto: " . implode(", ", $stmt->errorInfo()));
                return false;
            }
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
public function atualizarValorPorConsumo($idConsumo, $novoValor) {
        try {
            $sql = "UPDATE boleto SET valor = :valor WHERE id_consumo = :id_consumo";

            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":valor", $novoValor);
            $stmt->bindValue(":id_consumo", $idConsumo);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro ao atualizar valor do boleto pelo consumo: " . $e->getMessage());
            return false;
        }
    }

public function excluirBoletoPorConsumo($idConsumo) {
    try {
        $sql = "DELETE FROM boleto WHERE id_consumo = :id_consumo";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":id_consumo", (int)$idConsumo, PDO::PARAM_INT);
        $resultado = $stmt->execute();
        $stmt = null; // libera o statement
        return $resultado;
    } catch (PDOException $e) {
        error_log("Erro ao excluir boleto pelo consumo: " . $e->getMessage());
        return false;
    }
}

public function buscarPorId($id) {
    $stmt = $this->con->prepare("SELECT * FROM boleto WHERE id_boleto = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function buscarPorIdB($idBoleto) {
    try {
        $sql = "SELECT 
                    b.id_boleto,
                    b.id_morador,
                    b.id_consumo,
                    b.data_emissao,
                    b.data_vencimento,
                    b.valor,
                    b.status_boleto
                FROM boleto b
                WHERE b.id_boleto = :id_boleto
                LIMIT 1";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":id_boleto", (int)$idBoleto, PDO::PARAM_INT);
        $stmt->execute();

        $boleto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$boleto) {
            return null;
        }

        return $boleto;

    } catch (PDOException $e) {
        error_log("Erro em buscarPorIdB: " . $e->getMessage());
        return null;
    } catch (Exception $e) {
        error_log("Erro inesperado em buscarPorIdB: " . $e->getMessage());
        return null;
    }
}


public function buscarBoletoComDetalhes($idBoleto) {
        try {
            $sql = "SELECT id_boleto, id_morador, id_consumo, data_emissao, data_vencimento, valor, status_boleto
                    FROM boleto
                    WHERE id_boleto = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id", $idBoleto, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar boleto: " . $e->getMessage());
            return false;
        }
    }


}
?>
