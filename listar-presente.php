<h1>Presentes da Lista</h1>
<?php

// Verificar se o id_lista foi passado na URL
if (isset($_GET['id_lista'])) {
    $id_lista = $_GET['id_lista'];

    // Consultar os presentes da lista usando o id_lista
    $sql = "SELECT 
                presente.id_presente,
                presente.nome_presente,
                presente.descricao_presente,
                presente.preco_presente,
                presente.img_presente,
                lista.id_lista,
                lista.nome_lista
            FROM presente
            INNER JOIN lista ON presente.lista_id_lista = lista.id_lista
            WHERE lista.id_lista = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_lista);
    $stmt->execute();
    $result = $stmt->get_result();
    $qtd = $result->num_rows;

    if ($qtd > 0) {
        print "<p>Encontrou <b>$qtd</b> presente(s)</p>";
        print "<table class='table table-bordered table-striped table-hover'>";
        print "<tr>";
        print "<th>#</th>";
        print "<th>Nome do Presente</th>";
        print "<th>Descrição</th>";
        print "<th>Preço</th>";
        print "<th>Imagem</th>";
        print "<th>Ações</th>";
        print "</tr>";

        // Exibir os presentes
        while ($row = $result->fetch_object()) {
            $preco_formatado = number_format($row->preco_presente, 2, ',', '.'); // Formatar o preço
            print "<tr>";
            print "<td>" . $row->id_presente . "</td>";
            print "<td>" . $row->nome_presente . "</td>";
            print "<td>" . $row->descricao_presente . "</td>";
            print "<td>R$ " . $preco_formatado . "</td>";
            print "<td><img src='" . $row->img_presente . "' width='100'></td>";
            print "<td>";
            print "    <div style='display: flex; gap: 10px;'>"; // Usando flexbox para alinhar os botões lado a lado
            print "        <button class='btn btn-success' style='width: 100px;' onclick=\"location.href='?page=editar-presente&id_presente=" . $row->id_presente . "';\">Editar</button>";
            print "        <button class='btn btn-danger' style='width: 100px;' onclick=\"if(confirm('Tem certeza que deseja excluir?')) {location.href='?page=salvar-presente&acao=excluir&id_presente=" . $row->id_presente . "';} else {false;}\">Excluir</button>";
            print "    </div>";
            print "</td>";
            print "</tr>";
        }
        print "</table>";
    } else {
        print "Não encontrou nenhum presente nesta lista.";
    }
} else {
    print "<p>Selecione uma lista para visualizar os presentes.</p>";
}

?>
