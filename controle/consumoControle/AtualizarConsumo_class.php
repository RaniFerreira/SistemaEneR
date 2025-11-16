<?php
include_once(__DIR__ . "/../../modelo/consumoModelo/ConsumoDao_class.php");
include_once(__DIR__ . "/../../modelo/boletoModelo/BoletoDao_class.php");

class AtualizarConsumo {

    public function executar($idConsumo) {

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            die("Método inválido.");
        }

        // ✅ Validação do KWh
        if (!isset($_POST["kwh"]) || !is_numeric($_POST["kwh"]) || $_POST["kwh"] <= 0) {
            die("Erro: kWh inválido!");
        }

        $novoKwh = floatval($_POST["kwh"]);
        $idMorador = $_POST["id_morador"];

        // =======================================================
        // 1️⃣ Atualizar apenas o consumo
        // =======================================================
        $daoConsumo = new ConsumoDao();
        $ok = $daoConsumo->atualizarKwh($idConsumo, $novoKwh);

        if (!$ok) {
            die("Erro ao atualizar consumo!");
        }

        // =======================================================
        // 2️⃣ Atualizar apenas o valor do boleto
        // =======================================================
        $tarifa = 0.99;
        $novoValor = $novoKwh * $tarifa;

        $daoBoleto = new BoletoDao();
        $ok2 = $daoBoleto->atualizarValorPorConsumo($idConsumo, $novoValor);

        if (!$ok2) {
            die("Erro ao atualizar valor do boleto!");
        }

        // =======================================================
        // 3️⃣ Redirecionar de volta
        // =======================================================
        header("Location: /sistemaEneR/visao/form_painel_sindico.php?pagina=consumo");
exit;

    }
}
?>
