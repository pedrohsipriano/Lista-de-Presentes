<?php
switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $quantidade_listas = isset($_POST['quantidade_listas']) ? (int) $_POST['quantidade_listas'] : 0;

        if ($quantidade_listas > 0) {
            for ($i = 0; $i < $quantidade_listas; $i++) {
                $nome_lista = $_POST['nome_lista_' . ($i + 1)] ?? '';
                $descricao_lista = $_POST['descricao_lista_' . ($i + 1)] ?? '';
                $usuarios_compartilhar = $_POST['usuarios_compartilhar_' . ($i + 1)] ?? [];  // Array de usuários para compartilhar

                // Insira na tabela lista
                $sql = "INSERT INTO lista (nome_lista, descricao_lista, usuario_id_usuario) 
                        VALUES ('$nome_lista', '$descricao_lista', 1)"; // O '1' é o ID do usuário criador da lista

                $res = $conn->query($sql);
                $id_lista = $conn->insert_id; // Obtém o ID da lista inserida

                // Agora, vamos associar essa lista com outros usuários (compartilhar)
                if (!empty($usuarios_compartilhar)) {
                    foreach ($usuarios_compartilhar as $usuario_id) {
                        $sql_compartilhar = "INSERT INTO usuarios_listas (id_usuario, id_lista) 
                                             VALUES ($usuario_id, $id_lista)";
                        $conn->query($sql_compartilhar);
                    }
                }
            }

            print "<script>alert('Lista(s) de presentes cadastrada(s) com sucesso!');</script>";
            print "<script>location.href='?page=listar-lista';</script>";
        } else {
            print "<script>alert('Lista(s) de presentes não cadastrada(s)!');</script>";
            print "<script>location.href='?page=cadastrar-lista';</script>";
        }
        break;

    case 'editar':
        $nome_lista = $_POST['nome_lista'];
        $descricao_lista = $_POST['descricao_lista'];

        // Atualizar a lista no banco
        $sql = "UPDATE lista SET 
                    nome_lista = '{$nome_lista}', 
                    descricao_lista = '{$descricao_lista}'
                WHERE id_lista = " . $_POST["id_lista"];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Lista editada com sucesso!');</script>";
            print "<script>location.href='?page=listar-lista';</script>";
        } else {
            print "<script>alert('Erro ao editar a lista!');</script>";
            print "<script>location.href='?page=listar-lista';</script>";
        }
        break;

    case 'excluir':
        $id_lista = $_REQUEST["id_lista"];
        $sql = "DELETE FROM lista WHERE id_lista = $id_lista";
        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Lista excluída com sucesso!');</script>";
            print "<script>location.href='?page=listar-lista';</script>";
        } else {
            print "<script>alert('Erro ao excluir a lista!');</script>";
            print "<script>location.href='?page=listar-lista';</script>";
        }
        break;

    case 'compartilhar':
        $id_lista = $_REQUEST['id_lista'];
        $email_usuario_compartilhar = $_POST['email'];

        // Verificar se o e-mail existe no banco de dados
        $sql_verificar_usuario = "SELECT id_usuario FROM usuario WHERE email_usuario = '$email_usuario_compartilhar'";
        $res_usuario = $conn->query($sql_verificar_usuario);
        if ($res_usuario && $res_usuario->num_rows > 0) {
            $usuario_compartilhar = $res_usuario->fetch_object();
            $id_usuario_compartilhar = $usuario_compartilhar->id_usuario;

            // Compartilhar a lista com o usuário
            $sql_compartilhar = "INSERT INTO usuarios_listas (id_usuario, id_lista) 
                                     VALUES ($id_usuario_compartilhar, $id_lista)";
            if ($conn->query($sql_compartilhar)) {
                print "<script>alert('Lista compartilhada com sucesso!');</script>";
            } else {
                print "<script>alert('Erro ao compartilhar a lista!');</script>";
            }
        } else {
            print "<script>alert('E-mail não encontrado!');</script>";
        }

        // Redireciona de volta para a página da lista
        print "<script>location.href='?page=listar-lista';</script>";
        break;
}
?>