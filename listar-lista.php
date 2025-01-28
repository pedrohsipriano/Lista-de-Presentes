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
        print "<td>" . $row->id_lista . "</td>";
        print "<td>" . $row->nome_lista . "</td>";
        print "<td>" . $row->nome_usuario . "</td>";
        print "<td>" . $row->descricao_lista . "</td>";
        print "<td>" . $data_formatada . "</td>";
        print "<td>";
        print "    <div style='display: flex; gap: 10px;'>"; // Usando flexbox para alinhar os botões lado a lado
        print "        <button class='btn btn-success' style='width: 100px;' onclick=\"location.href='?page=editar-lista&id_lista=" . $row->id_lista . "';\">Editar</button>";
        print "        <button class='btn btn-success' style='width: 100px;' data-bs-toggle='modal' data-bs-target='#shareModal_" . $row->id_lista . "'>Compartilhar</button>"; // Botão para abrir o modal
        print "        <button class='btn btn-primary' style='width: 100px;' onclick=\"location.href='?page=cadastrar-presente&id_lista=" . $row->id_lista . "';\">Adicionar Presente</button>";
        print "        <button class='btn btn-primary' style='width: 100px;' onclick=\"location.href='?page=listar-presente&id_lista=" . $row->id_lista . "';\">Presentes cadastrados</button>";
        print "        <button class='btn btn-danger' style='width: 100px;' onclick=\"if(confirm('Tem certeza que deseja excluir?')) {location.href='?page=salvar-lista&acao=excluir&id_lista=" . $row->id_lista . "';} else {false;}\">Excluir</button>";
        print "    </div>";

        // Modal para compartilhar a lista
        print "    <div class='modal fade' id='shareModal_" . $row->id_lista . "' tabindex='-1' aria-labelledby='shareModalLabel' aria-hidden='true'>";
        print "        <div class='modal-dialog'>";
        print "            <div class='modal-content'>";
        print "                <div class='modal-header'>";
        print "                    <h5 class='modal-title' id='shareModalLabel'>Compartilhar Lista</h5>";
        print "                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
        print "                </div>";
        print "                <div class='modal-body'>";
        print "                    <form action='?page=salvar-lista&acao=compartilhar&id_lista=" . $row->id_lista . "' method='POST'>";
        print "                        <div class='mb-3'>";
        print "                            <label for='email' class='form-label'>E-mail do usuário para compartilhar:</label>";
        print "                            <input type='email' class='form-control' id='email' name='email' required>";
        print "                        </div>";
        print "                        <button type='submit' class='btn btn-primary'>Compartilhar</button>";
        print "                    </form>";
        print "                </div>";
        print "            </div>";
        print "        </div>";
        print "    </div>";
        "</td>";
        print "</tr>";
    }
    print "</table>";
} else {
    print "Não encontrou resutado";
}

?>