<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>Login</h1>
    <form action="login.php" method="post" class="form-control">
        <div class="mb-3">
            <label for="email_usuario">Email</label>
            <input type="email" name="email_usuario" id="email_usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="senha_usuario">Senha</label>
            <input type="password" name="senha_usuario" id="senha_usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Login</button>
        </div>
    </form>
    <!-- Botão para redirecionar para outra página -->
    <div class="mb-3">
        <a href="./cadastro-usuario.php" class="btn btn-primary">Ainda não é cadastrado?</a>
    </div>
</body>

</html>