<?php
include_once(__DIR__ . "/../../modelo/consumoModelo/Consumo_class.php");
include_once(__DIR__ . "/../../modelo/consumoModelo/ConsumoDao_class.php");
include_once(__DIR__ . "/../boletoControle/CadastrarBoleto_class.php");

class CadastrarConsumo {

    public function novaLeitura($idMorador) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $idMorador = $_SESSION["id_morador"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Cria o objeto de consumo
            $c = new Consumo();
            $c->setIdMorador($idMorador);
            $c->setDataLeitura(date("Y-m-d"));
            $c->setKwh($_POST["kwh"]);

            $dao = new ConsumoDao();
            $sucesso = $dao->cadastrar($c);

            // Se cadastrou o consumo, gera o boleto
            if ($sucesso) {
                $tarifa = 0.80; // exemplo de valor por kWh
                $valor = $_POST["kwh"] * $tarifa;

                $boletoCtrl = new CadastrarBoleto();
                $boletoCtrl->gerarBoleto($idMorador, $valor);
            }

            header("Location: visao/form_painel_morardor.php?pagina=leitura");
            exit;
        }
    }
}
?>
