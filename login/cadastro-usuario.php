<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>Cadastrar</h1>
    <form action="salvar-usuario.php" method="post" class="form-control">
        <div class="mb-3">
            <label for="">Nome</label>
            <input type="text" name="nome_usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" name="email_usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="">Sua Senha</label>
            <input type="text" name="senha_usuario" class="form-control" required>
        </div>
    </form>
    <div class="mb-3">
        <button type="submit" class="btn btn-success footer">Enviar</button>
    </div>
</body>

</html>
