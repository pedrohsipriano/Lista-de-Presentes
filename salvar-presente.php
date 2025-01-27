<?php
// Conectar com o banco de dados
include("conexao.php");

switch ($_POST['acao']) {
    case 'cadastrar':
        // Obter o id_lista do formulário
        $id_lista = $_POST['id_lista'];

        // Verificar se a quantidade de presentes foi definida
        $quantidade_presentes = $_POST['quantidade_presente'];

        if ($quantidade_presentes > 0) {
            // Loop para processar os presentes
            for ($i = 0; $i < $quantidade_presentes; $i++) {
                // Obter os dados de cada presente
                $nome_presente = $_POST['nome_presente_' . ($i + 1)] ?? '';
                $descricao_presente = $_POST['descricao_presente_' . ($i + 1)] ?? '';
                $preco_presente = $_POST['preco_real_' . ($i + 1)] ?? ''; // Usar o campo real para o preço
                $imagem_presente = $_POST['imagem_' . ($i + 1)] ?? '';

                // Verificar se o preço foi informado corretamente
                if (empty($preco_presente)) {
                    $preco_presente = 0.00; // Definir valor padrão se não houver preço
                }

                // Inserir o presente no banco de dados
                $sql = "INSERT INTO presente (nome_presente, descricao_presente, preco_presente, img_presente, usuario_id_usuario, lista_id_lista)
                        VALUES ('$nome_presente', '$descricao_presente', '$preco_presente', '$imagem_presente', 1, '$id_lista')";
                
                $res = $conn->query($sql);

                if ($res) {
                    echo "<script>alert('Presente(s) cadastrado(s) com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar presente(s)!');</script>";
                }
            }

            // Redirecionar de volta para a página de lista
            print "<script>location.href='?page=listar-lista';</script>";
        } else {
            print "<script>alert('Quantidade de presentes deve ser maior que 0!');</script>";
        }
        break;

    case 'editar':
        // Obter dados do presente a ser editado
        $id_presente = $_POST['id_presente'];
        $nome_presente = $_POST['nome_presente'];
        $descricao_presente = $_POST['descricao_presente'];
        $preco_presente = $_POST['preco_real'] ?? 0.00;
        $imagem_presente = $_POST['imagem_presente'];

        // Atualizar o presente no banco
        $sql = "UPDATE presente SET 
                    nome_presente = '$nome_presente',
                    descricao_presente = '$descricao_presente',
                    preco_presente = '$preco_presente',
                    img_presente = '$imagem_presente'
                WHERE id_presente = $id_presente";

        $res = $conn->query($sql);

        if ($res) {
            echo "<script>alert('Presente editado com sucesso!');</script>";
            print "<script>location.href='?page=listar-presente&id_lista=$id_lista';</script>";
        } else {
            echo "<script>alert('Erro ao editar presente!');</script>";
        }
        break;

    case 'excluir':
        $id_presente = $_POST['id_presente'];
        $sql = "DELETE FROM presente WHERE id_presente = $id_presente";
        $res = $conn->query($sql);

        if ($res) {
            echo "<script>alert('Presente excluído com sucesso!');</script>";
            print "<script>location.href='?page=listar-presente&id_lista=$id_lista';</script>";
        } else {
            echo "<script>alert('Erro ao excluir presente!');</script>";
        }
        break;

    default:
        echo "<script>alert('Ação não reconhecida!');</script>";
        print "<script>location.href='?page=listar-lista';</script>";
        break;
}
?>