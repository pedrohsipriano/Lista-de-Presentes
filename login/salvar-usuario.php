<?php
<<<<<<< HEAD
require_once "../config.php"; // Conexão com o banco
=======

require_once "../config.php";
>>>>>>> origin/main

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_usuario = $_POST["nome_usuario"];
    $email_usuario = $_POST["email_usuario"];
    $senha_usuario = $_POST["senha_usuario"];
    $hashed_password = password_hash($senha_usuario, PASSWORD_DEFAULT);

<<<<<<< HEAD
    // Preparando a consulta SQL
=======
    // Prepare a SQL statement
>>>>>>> origin/main
    $sql = "INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
<<<<<<< HEAD
        // Vinculando os parâmetros
        $stmt->bind_param("sss", $nome_usuario, $email_usuario, $hashed_password);

        // Executando a consulta
        if ($stmt->execute()) {
            // Redirecionando para a página login-usuario.php após o cadastro bem-sucedido
            header("Location: login-usuario.php");
            exit(); // Evita que o script continue
=======
        // Bind the parameters
        $stmt->bind_param("sss", $nome_usuario, $email_usuario, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
>>>>>>> origin/main
        } else {
            echo "Erro ao cadastrar usuário: " . $stmt->error;
        }

<<<<<<< HEAD
        // Fechando a consulta
=======
        // Close the statement
>>>>>>> origin/main
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }

<<<<<<< HEAD
    // Fechando a conexão
=======
    // Close the connection
>>>>>>> origin/main
    $conn->close();
}
?>
