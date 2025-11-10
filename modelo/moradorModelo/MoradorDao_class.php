<?php
include_once(__DIR__ . "/../ConnectionFactory_class.php");

class MoradorDAO {
    private $con;

    public function __construct() {
        $cf = new ConnectionFactory();
        $this->con = $cf->getConnection();
    }

    public function cadastrar($morador) {
        try {
            $stmt = $this->con->prepare("
                INSERT INTO morador (id_usuario, id_sindico, nome, nome_condominio, telefone)
                VALUES (:id_usuario, :id_sindico, :nome, :nome_condominio, :telefone)
            ");
            $stmt->bindValue(":id_usuario", $morador->getIdUsuario());
            $stmt->bindValue(":id_sindico", $morador->getIdSindico());
            $stmt->bindValue(":nome", $morador->getNome());
            $stmt->bindValue(":nome_condominio", $morador->getNomeCondominio());
            $stmt->bindValue(":telefone", $morador->getTelefone());
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar morador: " . $e->getMessage();
        }
    }
        public function listarPorSindico($idSindico) {
        try {
            $stmt = $this->con->prepare("
                SELECT m.id_morador, m.nome AS nome_morador, m.telefone, m.nome_condominio,
                    u.nome_usuario, u.email
                FROM morador m
                INNER JOIN usuario u ON m.id_usuario = u.id_usuario
                WHERE m.id_sindico = :id_sindico
                ORDER BY m.nome ASC
            ");
            $stmt->bindValue(":id_sindico", $idSindico);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar moradores: " . $e->getMessage();
            return [];
        }
    }

        public function buscarPorId($idMorador) {
        try {
            $stmt = $this->con->prepare("
                SELECT * FROM morador WHERE id_morador = :id_morador
            ");
            $stmt->bindValue(":id_morador", $idMorador);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar morador: " . $e->getMessage();
            return false;
        }
    }

    public function atualizar($morador) {
    try {
        $stmt = $this->con->prepare("
            UPDATE morador
            SET nome = :nome,
                nome_condominio = :nome_condominio,
                telefone = :telefone
            WHERE id_morador = :id_morador
        ");
        $stmt->bindValue(":nome", $morador->getNome());
        $stmt->bindValue(":nome_condominio", $morador->getNomeCondominio());
        $stmt->bindValue(":telefone", $morador->getTelefone());
        $stmt->bindValue(":id_morador", $morador->getIdMorador());
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao atualizar morador: " . $e->getMessage();
    }
}
    public function excluirMorador($idMorador) {
        try {
            $stmt = $this->con->prepare("
                DELETE FROM morador WHERE id_morador = :id_morador
            ");
            $stmt->bindValue(":id_morador", $idMorador, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir morador: " . $e->getMessage();
        }
    }

    // Buscar todos os boletos de um morador
    public function listarBoletosPorMorador($idMorador) {
        $sql = "SELECT id_boleto, data_emissao, data_vencimento, valor, status_boleto 
                FROM boletos 
                WHERE id_morador = :id_morador 
                ORDER BY data_vencimento DESC";

        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id_morador', $idMorador, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function buscarPorIdM($idMorador) {
    $sql = "SELECT nome AS morador_nome, nome_condominio AS morador_condominio
            FROM morador
            WHERE id_morador = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->execute([$idMorador]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}





}
?>
