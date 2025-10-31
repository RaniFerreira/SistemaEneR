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
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar leitura: ".$e->getMessage());
            return false;
        }
    }

	  // Lista todos os consumos de um morador
    public function listarPorMorador($idMorador) {
        try {
            $sql = "SELECT * FROM consumo WHERE id_morador = :id_morador ORDER BY data_leitura DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(":id_morador", $idMorador);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar consumos: " . $e->getMessage());
            return [];
        }
    }
}





?>