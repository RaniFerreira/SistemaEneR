<?php
include_once(__DIR__ . "/../../modelo/moradorModelo/MoradorDAO_class.php");
include_once(__DIR__ . "/../../modelo/usuarioModelo/UsuarioDAO_class.php");

class ExcluirMorador {
    public function excluir($idMorador) {
        // Instancia os DAOs
        $moradorDAO = new MoradorDAO();
        $usuarioDAO = new UsuarioDAO();

        // Primeiro pega o id_usuario vinculado a esse morador
        $usuario = $usuarioDAO->buscarUsuarioPorMorador($idMorador);

        if ($usuario) {
            $idUsuario = $usuario["id_usuario"];
            // Exclui o morador
            $moradorDAO->excluirMorador($idMorador);
            // Exclui o usuário
            $usuarioDAO->excluirUsuario($idUsuario);
        }

        // ✅ Redireciona de volta para a listagem
        header("Location: visao/form_painel_sindico.php?pagina=listarMoradores");
        exit;
    }
}
?>
