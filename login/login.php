<?php
session_start();
require_once "../config.php"; // Conexão com o banco

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação de campos (verifica se não estão vazios)
    if (!empty($_POST["email_usuario"]) && !empty($_POST["senha_usuario"])) {
        $email_usuario = trim($_POST["email_usuario"]);
        $senha_usuario = trim($_POST["senha_usuario"]);

        // Consulta SQL para buscar o usuário pelo email
        $sql = "SELECT * FROM usuario WHERE email_usuario = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param("s", $email_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Verificando se a senha está correta
            if (password_verify($senha_usuario, $row["senha_usuario"])) {
                // Configurando variáveis de sessão
                $_SESSION["loggedin"] = true;
                $_SESSION["usuario_id"] = $row["id_usuario"];
                $_SESSION["nome_usuario"] = $row["nome_usuario"];

                // Redireciona para o index
                header("Location: ../index.php");
                exit();
            } else {
                $error = "Senha incorreta.";
            }
        } else {
            $error = "Usuário não encontrado.";
        }

        $stmt->close();
    } else {
        $error = "Por favor, preencha todos os campos.";
    }
}

// Exibe a mensagem de erro com alerta JavaScript
if (!empty($error)) {
    echo "<script>alert('$error');</script>";
    echo "<script>location.href='login-usuario.php';</script>";
    exit();
}
?>
