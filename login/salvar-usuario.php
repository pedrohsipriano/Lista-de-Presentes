<?php

require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_usuario = $_POST["nome_usuario"];
    $email_usuario = $_POST["email_usuario"];
    $senha_usuario = $_POST["senha_usuario"];
    $hashed_password = password_hash($senha_usuario, PASSWORD_DEFAULT);

    // Prepare a SQL statement
    $sql = "INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("sss", $nome_usuario, $email_usuario, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar usuário: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
