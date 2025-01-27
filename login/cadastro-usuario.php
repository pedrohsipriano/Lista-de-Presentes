<form action="salvar-usuario.php" method="post" class="form-control">
    <div class="mb-3">
        <label for="nome_usuario">Nome</label>
        <input type="text" name="nome_usuario" id="nome_usuario" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email_usuario">Email</label>
        <input type="email" name="email_usuario" id="email_usuario" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="senha_usuario">Sua Senha</label>
        <input type="password" name="senha_usuario" id="senha_usuario" class="form-control" required>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </div>
</form>
