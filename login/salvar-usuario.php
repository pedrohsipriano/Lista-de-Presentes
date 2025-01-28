<?php
require_once "../config.php"; // Conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_usuario = $_POST["nome_usuario"];
    $email_usuario = $_POST["email_usuario"];
    $senha_usuario = $_POST["senha_usuario"];
    $hashed_password = password_hash($senha_usuario, PASSWORD_DEFAULT);

    // Preparando a consulta SQL
    $sql = "INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vinculando os parâmetros
        $stmt->bind_param("sss", $nome_usuario, $email_usuario, $hashed_password);

        // Executando a consulta
        if ($stmt->execute()) {
            // Redirecionando para a página login-usuario.php após o cadastro bem-sucedido
            header("Location: login-usuario.php");
            exit(); // Evita que o script continue
        } else {
            echo "Erro ao cadastrar usuário: " . $stmt->error;
        }

        // Fechando a consulta
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    // Fechando a conexão
    $conn->close();
}
?>
