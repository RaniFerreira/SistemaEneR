<?php
include_once(__DIR__ . "/../../modelo/consumoModelo/Consumo_class.php");
include_once(__DIR__ . "/../../modelo/consumoModelo/ConsumoDao_class.php");
include_once(__DIR__ . "/../boletoControle/CadastrarBoleto_class.php");

class CadastrarConsumo {

    public function novaLeitura($idMoradorParam = null) {
        if (session_status() == PHP_SESSION_NONE) session_start();

        $idMorador = $idMoradorParam ?? $_SESSION["id_morador"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!isset($_POST["kwh"]) || !is_numeric($_POST["kwh"]) || $_POST["kwh"] <= 0) {
                die("Erro: Valor de kWh inválido!");
            }

            $kwh = floatval($_POST["kwh"]);

            $c = new Consumo();
            $c->setIdMorador($idMorador);
            $c->setDataLeitura(date("Y-m-d"));
            $c->setKwh($kwh);

            $dao = new ConsumoDao();
            $idConsumo = $dao->cadastrar($c);

            if (!$idConsumo) die("Erro: Não foi possível cadastrar o consumo!");

            $valor = $kwh * 0.99;

            $boletoCtrl = new CadastrarBoleto();
            $gerouBoleto = $boletoCtrl->gerarBoleto($idMorador, $valor, $idConsumo);

            if (!$gerouBoleto) die("Erro: Não foi possível gerar o boleto!");

            header("Location: visao/form_painel_morardor.php?pagina=leitura&status=sucesso");

            exit;
        }
    }
}
?>
