<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "1 - Início<br>";
session_start();
ob_start();

echo "2 - Sessão iniciada<br>";
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once(__DIR__ . "/../modelo/ConnectionFactory_class.php");

    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha)) {
        $mensagem = "❌ E-mail e senha são obrigatórios!";
    } else {
        $factory = new ConnectionFactory();
        $conn = $factory->getConnection();

        try {
            // 1️⃣ Buscar usuário pelo e-mail
            $stmt = $conn->prepare("SELECT * FROM usuario WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$usuario || !password_verify($senha, $usuario['senha'])) {
                // redireciona de volta para o form passando a mensagem
                $mensagem = urlencode("❌ E-mail ou senha incorretos!");
                header("Location: ../visao/form_login.php?erro=$mensagem");
                exit;
            } else {
                // Login ok
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
                $id_usuario = $usuario['id_usuario'];

                // 2️⃣ Verifica se é síndico
                $stmt_sindico = $conn->prepare("SELECT * FROM sindico WHERE id_usuario = ?");
                $stmt_sindico->execute([$id_usuario]);
                $sindico = $stmt_sindico->fetch(PDO::FETCH_ASSOC);

                if ($sindico) {
                    $_SESSION['tipo_usuario'] = 'sindico';
                    $_SESSION['id_sindico'] = $sindico['id_sindico'];
                    $_SESSION['nome_condominio'] = $sindico['nome_condominio']; // <- ESSENCIAL
                    header("Location: ../visao/form_painel_sindico.php");
                    exit;
                }

                // 3️⃣ Verifica se é morador
                $stmt_morador = $conn->prepare("SELECT * FROM morador WHERE id_usuario = ?");
                $stmt_morador->execute([$id_usuario]);
                $morador = $stmt_morador->fetch(PDO::FETCH_ASSOC);

                if ($morador) {
                    $_SESSION['tipo_usuario'] = 'morador';
                    $_SESSION['id_morador'] = $morador['id_morador'];
                    $_SESSION['id_sindico'] = $morador['id_sindico'];
                    header("Location: ../visao/form_painel_morardor.php");
                    exit;
                }

                $mensagem = "❌ Usuário sem perfil definido!";
            }

        } catch (PDOException $e) {
            error_log("Erro no login: " . $e->getMessage());
            $mensagem = "❌ Erro no login, tente novamente!";
        }
    }
}
?>
