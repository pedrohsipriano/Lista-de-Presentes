<?php
session_start();  // Inicia a sessão

require_once "../config.php";  // Incluindo a configuração do banco de dados

$error = '';  // Variável para mensagens de erro

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validando os campos de entrada
    if (isset($_POST["email_usuario"]) && isset($_POST["senha_usuario"])) {
        $email_usuario = $_POST["email_usuario"];
        $senha_usuario = $_POST["senha_usuario"];

        // Preparando a consulta SQL para evitar SQL Injection
        $sql = "SELECT * FROM usuario WHERE email_usuario = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        // Vinculando o parâmetro
        $stmt->bind_param("s", $email_usuario);

        // Executando a consulta
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificando se o usuário foi encontrado
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Verificando se a senha está correta
            if (password_verify($senha_usuario, $row["senha_usuario"])) {
                $_SESSION["loggedin"] = true;  // Definindo a sessão
                $_SESSION["usuario_id"] = $row["id_usuario"];  // Salvando o ID do usuário na sessão
                // Redireciona para a página inicial (index.php) após login bem-sucedido
                header("Location: ../index.php");
                exit(); // Evita que o script continue
            } else {
                // Senha incorreta
                $error = "Senha incorreta.";
            }
        } else {
            // Usuário não encontrado
            $error = "Usuário ou email incorretos.";
        }

        // Fechando a consulta
        $stmt->close();
    } else {
        // Caso algum campo não tenha sido preenchido
        $error = "Por favor, preencha todos os campos.";
    }
}
?>
