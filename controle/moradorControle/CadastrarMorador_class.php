<?php
include_once(__DIR__ . "/../../modelo/usuarioModelo/Usuario_class.php");
include_once(__DIR__ . "/../../modelo/usuarioModelo/UsuarioDAO_class.php");
include_once(__DIR__ . "/../../modelo/moradorModelo/Morador_class.php");
include_once(__DIR__ . "/../../modelo/moradorModelo/MoradorDAO_class.php");

class CadastrarMorador {
    public function cadastrar($id_sindico) {
        $status = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $nomeUsuario = trim($_POST["nome_usuario"]);
            $email = trim($_POST["email"]);
            $senha = $_POST["senha"];
            $nomeMorador = trim($_POST["nome_morador"]);
            $condominio = trim($_POST["condominio"]);
            $telefone = trim($_POST["telefone"]);

            $usuarioDAO = new UsuarioDAO();

            // 🔍 Verifica se o email já existe
            if ($usuarioDAO->emailExiste($email)) {
                $_SESSION['status'] = "⚠️ O email <b>{$email}</b> já está cadastrado. Por favor, use outro.";
            } else {
                // 🧍 Cadastra o usuário
                $usuario = new Usuario();
                $usuario->setNomeUsuario($nomeUsuario);
                $usuario->setEmail($email);
                $usuario->setSenha($senha);

                $idUsuario = $usuarioDAO->cadastrar($usuario);

                if ($idUsuario) {
                    // 🧾 Cadastra o morador
                    $morador = new Morador();
                    $morador->setIdUsuario($idUsuario);
                    $morador->setIdSindico($id_sindico);
                    $morador->setNome($nomeMorador);
                    $morador->setNomeCondominio($condominio);
                    $morador->setTelefone($telefone);

                    $moradorDAO = new MoradorDAO();
                    $moradorDAO->cadastrar($morador);

                    $_SESSION['status'] = "✅ Morador cadastrado com sucesso!";
                } else {
                    $_SESSION['status'] = "❌ Erro ao cadastrar o usuário. Verifique os dados e tente novamente.";
                }
            }
        }

         header("Location: visao/form_painel_sindico.php?pagina=cadastrar_morador");
            exit;
    }
}
?>
