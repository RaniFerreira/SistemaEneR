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
                (id_morador, id_sindico, titulo, descricao, data_reclamacao, status_reclamacao, resposta)
                VALUES (:id_morador, :id_sindico, :titulo, :descricao, :data_reclamacao, :status_reclamacao, :resposta)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindValue(":id_morador", $r->getIdMorador() ?? null, PDO::PARAM_INT);
        $stmt->bindValue(":id_sindico", $r->getIdSindico() ?? null, PDO::PARAM_INT);
        $stmt->bindValue(":titulo", $r->getTitulo());
        $stmt->bindValue(":descricao", $r->getDescricao());
        $stmt->bindValue(":data_reclamacao", $r->getDataReclamacao() ?? date("Y-m-d"));
        $stmt->bindValue(":status_reclamacao", $r->getStatusReclamacao() ?? "Pendente");
        $stmt->bindValue(":resposta", "?"); // valor inicial padrão

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
public function listarAguardandoPorSindico($idSindico) {
    $sql = "
        SELECT 
            r.id_reclamacao,
            r.titulo,
            r.descricao,
            r.status_reclamacao,
            r.data_reclamacao,
            m.nome AS nome_morador
        FROM reclamacao r
        LEFT JOIN morador m ON r.id_morador = m.id_morador
        WHERE 
            (
                m.id_sindico = :idSindico     -- Reclamações dos moradores do síndico
                OR r.id_sindico = :idSindico  -- Reclamações internas do síndico
            )
            AND r.status_reclamacao = 'Aguardando análise da Ouvidoria'
        ORDER BY r.data_reclamacao DESC
    ";

    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':idSindico', $idSindico, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function listarAprovadasPorSindico($idSindico) {
    $sql = "
        SELECT 
            r.id_reclamacao,
            r.titulo,
            r.descricao,
            r.status_reclamacao,
            r.data_reclamacao,
            m.nome AS nome_morador
        FROM reclamacao r
        LEFT JOIN morador m ON r.id_morador = m.id_morador
        WHERE 
            (
                m.id_sindico = :idSindico
                OR r.id_sindico = :idSindico
            )
            AND r.status_reclamacao = 'Ajuste Aprovado'
        ORDER BY r.data_reclamacao DESC
    ";

    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':idSindico', $idSindico, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function listarReprovadasPorSindico($idSindico) {
    $sql = "
        SELECT 
            r.id_reclamacao,
            r.titulo,
            r.descricao,
            r.status_reclamacao,
            r.data_reclamacao,
            m.nome AS nome_morador
        FROM reclamacao r
        LEFT JOIN morador m ON r.id_morador = m.id_morador
        WHERE 
            (
                m.id_sindico = :idSindico
                OR r.id_sindico = :idSindico
            )
            AND r.status_reclamacao = 'Ajuste Reprovado'
        ORDER BY r.data_reclamacao DESC
    ";

    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':idSindico', $idSindico, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function atualizarReclamacaoSindico($id, $titulo, $descricao, $status, $resposta) {
    $sql = "UPDATE reclamacao 
            SET titulo = ?, descricao = ?, status_reclamacao = ?, resposta = ?
            WHERE id_reclamacao = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->execute([$titulo, $descricao, $status, $resposta, $id]);
}






}
?>
