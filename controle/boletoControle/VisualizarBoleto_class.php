<?php
include_once(__DIR__ . "/../../modelo/boletoModelo/BoletoDao_class.php");
include_once(__DIR__ . "/../../modelo/consumoModelo/ConsumoDao_class.php");
include_once(__DIR__ . "/../../modelo/moradorModelo/MoradorDao_class.php");

class VisualizarBoleto {
    private $idBoleto;

    public function __construct($idBoleto) {
        $this->idBoleto = $idBoleto;
    }

    public function getDadosCompleto() {
        $boletoDao = new BoletoDao();
        $consumoDao = new ConsumoDao();
        $moradorDao = new MoradorDao();

        $boleto = $boletoDao->buscarPorId($this->idBoleto);
        if (!$boleto) return null;

        $morador = $moradorDao->buscarPorId($boleto['id_morador']);
        $consumo = $consumoDao->buscarUltimoPorMorador($boleto['id_morador']);

        return [
            'morador_nome' => $morador['nome'] ?? '—',
            'morador_condominio' => $morador['nome_condominio'] ?? '—',
            'data_emissao' => date("d/m/Y", strtotime($boleto['data_emissao'])),
            'data_vencimento' => date("d/m/Y", strtotime($boleto['data_vencimento'])),
            'valor' => number_format($boleto['valor'], 2, ',', '.'),
            'status_boleto' => $boleto['status_boleto'],
            'kwh' => $consumo['kwh'] ?? '—'
        ];
    }
}
