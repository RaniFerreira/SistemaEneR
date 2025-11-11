<?php
include_once(__DIR__ . "/../../modelo/reclamacaoModelo/ReclamacaoDao_class.php");

class AtualizarReclamacaoOuvidoria {

    public function AtualizarReclamacao($id_sindico) {
        // Verifica se os campos obrigatórios foram enviados
        if (
            !isset($_POST["id_reclamacao"], $_POST["titulo"], $_POST["descricao"], $_POST["status_reclamacao"])
        ) {
            echo "<script>alert('Dados incompletos.'); history.back();</script>";
            exit;
        }

        // Captura os dados enviados
        $id = $_POST["id_reclamacao"];
        $titulo = trim($_POST["titulo"]);
        $descricao = trim($_POST["descricao"]);
        $status = trim($_POST["status_reclamacao"]);
        $resposta = isset($_POST["resposta"]) ? trim($_POST["resposta"]) : null;

        // Instancia o DAO
        $dao = new ReclamacaoDao();

        // Atualiza a reclamação (incluindo resposta)
        $dao->atualizarReclamacaoSindico($id, $titulo, $descricao, $status, $resposta);

        // ✅ Redireciona de volta para o painel da ouvidoria
        header("Location: visao/form_painel_ouvidoria.php?pagina=listarReclamacoes");
        exit;
    }
}
?>
