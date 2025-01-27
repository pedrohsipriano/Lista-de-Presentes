<?php
switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $quantidade_listas = isset($_POST['quantidade_listas']) ? (int)$_POST['quantidade_listas'] : 0;
    
        if ($quantidade_listas > 0) {
            for ($i = 0; $i < $quantidade_listas; $i++) {
                $nome_lista = $_POST['nome_lista_' . ($i + 1)] ?? '';
                $descricao_lista = $_POST['descricao_lista_' . ($i + 1)] ?? '';
    
                // Insira na tabela lista
                $sql = "INSERT INTO lista 
                            (nome_lista, 
                            descricao_lista, 
                            usuario_id_usuario)
                            VALUES 
                            ('$nome_lista', 
                            '$descricao_lista', 
                            1)"; // Ajuste o ID do usuário conforme necessário
    
                $res = $conn->query($sql);
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
}
?>
