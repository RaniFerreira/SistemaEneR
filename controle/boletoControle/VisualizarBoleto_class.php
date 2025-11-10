<?php
include_once(__DIR__ . "/../../modelo/boletoModelo/BoletoDao_class.php");
include_once(__DIR__ . "/../../modelo/moradorModelo/MoradorDao_class.php");
include_once(__DIR__ . "/../../modelo/consumoModelo/ConsumoDao_class.php");

class VisualizarBoleto {
    private $idBoleto;

    public function __construct($idBoleto) {
        $this->idBoleto = $idBoleto;
    }

    public function getDadosCompleto() {
        try {
            $boletoDao = new BoletoDao();
            $boleto = $boletoDao->buscarPorId($this->idBoleto);

            if (!$boleto) {
                return null;
            }

            // 🔹 Buscar dados do morador
            $moradorDao = new MoradorDao();
            $morador = $moradorDao->buscarPorIdM($boleto['id_morador']);

            // 🔹 Buscar dados de consumo (somente se existir)
            $consumoDao = new ConsumoDao();
            $consumo = null;
            if (!empty($boleto['id_consumo'])) {
                $consumo = $consumoDao->buscarPorId($boleto['id_consumo']);
            }

            // 🔹 Montar array final com todos os dados
            $dadosCompletos = [
                'id_boleto'          => $boleto['id_boleto'],
                'data_emissao'       => $boleto['data_emissao'],
                'data_vencimento'    => $boleto['data_vencimento'],
                'valor'              => $boleto['valor'],
                'status_boleto'      => $boleto['status_boleto'],
                'id_morador'         => $boleto['id_morador'],
                'id_consumo'         => $boleto['id_consumo'],
                'morador_nome'       => $morador['morador_nome'] ?? '—',
                'morador_condominio' => $morador['morador_condominio'] ?? '—',
                'morador_apartamento'=> $morador['morador_apartamento'] ?? '—',
                'consumo_kwh'        => $consumo['kwh'] ?? '—',
                'consumo_mes'        => $consumo['mes_referencia'] ?? '—',
                'consumo_valor'      => $consumo['valor'] ?? '—'
            ];

            return $dadosCompletos;

        } catch (PDOException $e) {
            error_log("Erro ao buscar dados completos do boleto: " . $e->getMessage());
            return null;
        }
    }
}
?>
