<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('BASE', 'listadepresentes');

$conn = new mysqli(HOST, USER, PASS, BASE);

// Verificando se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}

// Definindo a codificação de caracteres (opcional, mas recomendável)
$conn->set_charset("utf8");

?>
