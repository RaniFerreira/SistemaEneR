<?php
include_once(__DIR__ . "/../../modelo/usuarioModelo/Usuario_class.php");
include_once(__DIR__ . "/../../modelo/usuarioModelo/UsuarioDAO_class.php");
include_once(__DIR__ . "/../../modelo/moradorModelo/Morador_class.php");
include_once(__DIR__ . "/../../modelo/moradorModelo/MoradorDAO_class.php");

class AtualizarMorador {

    public function atualizar($id_morador) {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            // Campos do formulário
            $nomeUsuario   = trim($_POST["nome_usuario"]);
            $email         = trim($_POST["email"]);
            $senha         = $_POST["senha"];
            $nomeMorador   = trim($_POST["nome_morador"]);
            $condominio    = trim($_POST["condominio"]);
            $telefone      = trim($_POST["telefone"]);

            $moradorDAO = new MoradorDAO();
            $usuarioDAO = new UsuarioDAO();

            // Busca o morador atual para pegar o ID do usuário
            $moradorAtual = $moradorDAO->buscarPorId($id_morador);

            if ($moradorAtual) {
                $idUsuario = $moradorAtual["id_usuario"];

                // Atualiza usuário
                $usuario = new Usuario();
                $usuario->setIdUsuario($idUsuario);
                $usuario->setNomeUsuario($nomeUsuario);
                $usuario->setEmail($email);
                $usuario->setSenha($senha);

                $usuarioDAO->atualizar($usuario);

                // Atualiza morador
                $morador = new Morador();
                $morador->setIdMorador($id_morador);
                $morador->setNome($nomeMorador);
                $morador->setNomeCondominio($condominio);
                $morador->setTelefone($telefone);

                $moradorDAO->atualizar($morador);

                $_SESSION['status'] = "✅ Morador atualizado com sucesso!";
            } else {
                $_SESSION['status'] = "❌ Morador não encontrado.";
            }

            // ✅ Redireciona de volta para o painel
            header("Location: visao/form_painel_sindico.php?pagina=listarMoradores");
            exit;
        }
    }
}
?>
