<?php
include_once(__DIR__ . "/../../modelo/usuarioModelo/Usuario_class.php");
include_once(__DIR__ . "/../../modelo/usuarioModelo/UsuarioDAO_class.php");
include_once(__DIR__ . "/../../modelo/sindicoModelo/SindicoDAO_class.php");
include_once(__DIR__ . "/../../modelo/sindicoModelo/Sindico_class.php");

class CadastrarSindico {
    public function __construct() {
        $status = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nomeUsuario = trim($_POST["nome_usuario"]);
            $email = trim($_POST["email"]);
            $senha = $_POST["senha"];
            $nomeSindico = trim($_POST["nome_sindico"]);
            $condominio = trim($_POST["condominio"]);
            $telefone = trim($_POST["telefone"]);

            $usuarioDAO = new UsuarioDAO();

            // 🔍 Verifica se o email já existe
            if ($usuarioDAO->emailExiste($email)) {
                $status = "⚠️ O email <b>{$email}</b> já está cadastrado. Por favor, use outro.";
            } else {
                // 🧍 Cadastra o usuário
                $u = new Usuario();
                $u->setNomeUsuario($nomeUsuario);
                $u->setEmail($email);
                $u->setSenha($senha);

                $idUsuario = $usuarioDAO->cadastrar($u);

                // 🧾 Se o usuário foi cadastrado com sucesso
                if ($idUsuario) {
                    $s = new Sindico();
                    $s->setIdUsuario($idUsuario);
                    $s->setNome($nomeSindico);
                    $s->setNomeCondominio($condominio);
                    $s->setTelefone($telefone);

                    $sindicoDAO = new SindicoDAO();
                    $sindicoDAO->cadastrar($s);

                    $status = "✅ Síndico cadastrado com sucesso!";
                } else {
                    $status = "❌ Erro ao cadastrar o usuário. Verifique os dados e tente novamente.";
                }
            }
        }

        include_once("visao/form_cadastro_sindico.php");
    }
}
?>
