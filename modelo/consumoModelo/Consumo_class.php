<?php

    class Consumo{
        private $id_consumo;
		private $id_morador;
		private $data_leitura;
		private $kwh;

        public function __construct(){
		}

        // Getters e Setters
    public function getIdConsumo() {
        return $this->id_consumo;
    }

    public function setIdConsumo($id_consumo) {
        $this->id_consumo = $id_consumo;
    }

    public function getIdMorador() {
        return $this->id_morador;
    }

    public function setIdMorador($id_morador) {
        $this->id_morador = $id_morador;
    }

    public function getDataLeitura() {
        return $this->data_leitura;
    }

    public function setDataLeitura($data_leitura) {
        $this->data_leitura = $data_leitura;
    }

    public function getKwh() {
        return $this->kwh;
    }

    public function setKwh($kwh) {
        $this->kwh = $kwh;
    }
}

        

    






?>