<?php

class Boleto {

    private $id_boleto;
    private $id_morador;
    private $id_consumo;     // ✅ NOVO
    private $data_emissao;
    private $data_vencimento;
    private $valor;
    private $status_boleto;

    // ======= GETTERS =======
    public function getIdBoleto() {
        return $this->id_boleto;
    }

    public function getIdMorador() {
        return $this->id_morador;
    }

    public function getIdConsumo() {      // ✅ NOVO
        return $this->id_consumo;
    }

    public function getDataEmissao() {
        return $this->data_emissao;
    }

    public function getDataVencimento() {
        return $this->data_vencimento;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getStatusBoleto() {
        return $this->status_boleto;
    }

    // ======= SETTERS =======
    public function setIdBoleto($id_boleto) {
        $this->id_boleto = $id_boleto;
    }

    public function setIdMorador($id_morador) {
        $this->id_morador = $id_morador;
    }

    public function setIdConsumo($id_consumo) {   // ✅ NOVO
        $this->id_consumo = $id_consumo;
    }

    public function setDataEmissao($data_emissao) {
        $this->data_emissao = $data_emissao;
    }

    public function setDataVencimento($data_vencimento) {
        $this->data_vencimento = $data_vencimento;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setStatusBoleto($status_boleto) {
        $this->status_boleto = $status_boleto;
    }
}
?>
