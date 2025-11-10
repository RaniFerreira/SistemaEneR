<?php
	include_once(__DIR__ . "/../ConnectionFactory_class.php");
include_once(__DIR__ . "/Consumo_class.php"); // se estiver na mesma pasta
	
	class ConsumoDao{
	//DAO - Data Access Object	
	//CRUD - Creat, Read, Update e Delete
	//operações básicas de banco de dados
	
		public $con = null; //obj recebe conexão
		
		public function __construct(){
			$conF = new ConnectionFactory();
			$this->con = $conF->getConnection();
	}


   public function cadastrar(Consumo $c) {
        try {
            $sql = "INSERT INTO consumo (id_morador, data_leitura, kwh) 
                    VALUES (:id_morador, :data_leitura, :kwh)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id_morador", $c->getIdMorador());
            $stmt->bindValue(":data_leitura", $c->getDataLeitura());
            $stmt->bindValue(":kwh", $c->getKwh());
            $stmt->execute();

            return $this->con->lastInsertId(); // Retorna o ID do consumo
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar consumo: " . $e->getMessage());
            return false;
        }
    }

	 // ✅ Listar consumos por morador
    public function listarPorMorador($idMorador) {
        try {
            $sql = "SELECT * FROM consumo
                    WHERE id_morador = :id
                    ORDER BY data_leitura DESC";

            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id", $idMorador);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Erro ao listar consumos: " . $e->getMessage());
            return [];
        }
    }

   public function atualizarKwh($idConsumo, $kwh) {
    try {
        $sql = "UPDATE consumo SET kwh = :kwh WHERE id_consumo = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":kwh", $kwh);
        $stmt->bindValue(":id", $idConsumo);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erro ao atualizar consumo: " . $e->getMessage());
        return false;
    }
}
public function excluirConsumo($idConsumo) {
    try {
        $sql = "DELETE FROM consumo WHERE id_consumo = :id_consumo";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":id_consumo", (int)$idConsumo, PDO::PARAM_INT);
        $resultado = $stmt->execute();
        $stmt = null; // libera o statement
        return $resultado;
    } catch (PDOException $e) {
        error_log("Erro ao excluir consumo: " . $e->getMessage());
        return false;
    }
}
public function buscarPorId($idConsumo) {
        $sql = "SELECT kwh FROM consumo WHERE id_consumo = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$idConsumo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



}





?>