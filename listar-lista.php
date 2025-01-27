<h1>Listas</h1>
<?php

$sql = "SELECT 
    usuario.id_usuario,
    usuario.nome_usuario,
    lista.id_lista,
    lista.nome_lista,
    lista.descricao_lista,
    lista.data_lista
    FROM lista
    INNER JOIN usuario 
    ON lista.usuario_id_usuario = usuario.id_usuario";

$res = $conn->query($sql);
$qtd = $res->num_rows;

if ($qtd > 0) {
    print "<p>Encontrou <b>$qtd</b> resultado(s)</p>";
    print "<table class='table table-bordered table-striped table-hover'>";
    print "<tr>";
    print "<th>#</th>";
    print "<th>Nome da Lista</th>";
    print "<th>Nome do Criador</th>";
    print "<th>Descrição</th>";
    print "<th>Data e Hora da Criação</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        $data_formatada = DateTime::createFromFormat('Y-m-d H:i:s', $row->data_lista)->format('d/m/Y H:i');
        print "<tr>";
        print "<td>" . $row->id_lista  . "</td>";
        print "<td>" . $row->nome_lista . "</td>";
        print "<td>" . $row->nome_usuario . "</td>";
        print "<td>" . $row->descricao_lista . "</td>";
        print "<td>" . $data_formatada . "</td>";
        print "<td>";
        print "    <div style='display: flex; gap: 10px;'>"; // Usando flexbox para alinhar os botões lado a lado
        print "        <button class='btn btn-success' style='width: 100px;' onclick=\"location.href='?page=editar-lista&id_lista=" . $row->id_lista . "';\">Editar</button>";
        print "        <button class='btn btn-primary' style='width: 100px;' onclick=\"location.href='?page=cadastrar-presente&id_lista=" . $row->id_lista . "';\">Adicionar Presente</button>";
        print "        <button class='btn btn-primary' style='width: 100px;' onclick=\"location.href='?page=listar-presente&id_lista=" . $row->id_lista . "';\">Presentes cadastrados</button>";
        print "        <button class='btn btn-danger' style='width: 100px;' onclick=\"if(confirm('Tem certeza que deseja excluir?')) {location.href='?page=salvar-lista&acao=excluir&id_lista=" . $row->id_lista . "';} else {false;}\">Excluir</button>";
        print "    </div>";
        "</td>";
        print "</tr>";
    }
    print "</table>";
} else {
    print "Não encontrou resutado";
}

?>