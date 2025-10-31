<?php
include_once(__DIR__ . "/../../modelo/reclamacaoModelo/Reclamacao_class.php");
include_once(__DIR__ . "/../../modelo/reclamacaoModelo/ReclamacaoDao_class.php");

class CadastrarReclamacao {

    // Cadastrar reclamação do morador
    public function novaReclamacaoMorador($idMorador) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $idMorador = $_SESSION["id_morador"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Cria o objeto de reclamação
            $r = new Reclamacao();
            $r->setIdMorador($idMorador);
            $r->setIdSindico(null); // morador não tem síndico vinculado na reclamação
            $r->setTitulo($_POST["titulo"]);
            $r->setDescricao($_POST["descricao"]);
            $r->setDataReclamacao(date("Y-m-d H:i:s")); // data atual
            $r->setStatusReclamacao("Aguardando análise da Ouvidoria"); // status inicial

            $dao = new ReclamacaoDao();
            $dao->cadastrar($r);

            // Redireciona de volta para o painel do morador
            header("Location: visao/form_painel_morardor.php?pagina=correcao");
            exit;
        }
    }

    // Cadastrar reclamação do síndico
    public function novaReclamacaoSindico($idSindico) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $idSindico = $_SESSION["id_sindico"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $r = new Reclamacao();
            $r->setIdMorador(null); // síndico não é morador
            $r->setIdSindico($idSindico);
            $r->setTitulo($_POST["titulo"]);
            $r->setDescricao($_POST["descricao"]);
            $r->setDataReclamacao(date("Y-m-d"));
            $r->setStatusReclamacao("Aguardando análise da Ouvidoria");

            $dao = new ReclamacaoDao();
            $dao->cadastrar($r);

            header("Location: visao/form_painel_sindico.php?pagina=correcao");
            exit;
        }
    }
}
?>
