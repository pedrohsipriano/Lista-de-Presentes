<h1>Cadastrar Presentes</h1>
<?php
// Verificar se o id_lista foi passado na URL
if (isset($_GET['id_lista'])) {
    $id_lista = $_GET['id_lista'];

    // Consultar o nome da lista usando o id_lista
    $sql = "SELECT nome_lista FROM lista WHERE id_lista = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_lista);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_lista = $row['nome_lista'];
        // Exibir o nome da lista no <h2>
        echo "<h4>Lista: " . htmlspecialchars($nome_lista) . "</h4>";
    } else {
        echo "<h2>Lista não encontrada.</h2>";
    }
} else {
    echo "<h2>Selecione uma lista para adicionar presentes.</h2>";
}
?>
<form action="?page=salvar-presente" method="POST" id="presenteForm">
    <input type="hidden" name="acao" value="cadastrar">
    <input type="hidden" name="id_lista" value="<?php echo $id_lista; ?>"> <!-- Passa o id da lista -->

    <div class="mb-3">
        <label for="">Quantos presentes você quer adicionar?</label>
        <input type="number" id="quantidade_presente" name="quantidade_presente" class="form-control" value="1" min="1" max="10" onchange="updateForms()">
    </div>
    
    <div id="presenteFields">
        <!-- Aqui serão gerados os formulários dos presentes -->
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success footer">Enviar</button>
    </div>
</form>
<script>
    // Função para adicionar os formulários automaticamente
    function updateForms() {
        const quantidadePresente = document.getElementById('quantidade_presente').value;
        const presenteFields = document.getElementById('presenteFields');
        presenteFields.innerHTML = ''; // Limpa os campos anteriores

        for (let i = 0; i < quantidadePresente; i++) {
            const newForm = document.createElement('div');
            newForm.classList.add('presente-form');

            newForm.innerHTML = `
            <br><br>
            <div class="mb-3">
                <label for="">Nome do presente - ${i + 1}</label>
                <input type="text" name="nome_presente_${i + 1}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Descrição - ${i + 1}</label>
                <input type="text" name="descricao_presente_${i + 1}" class="form-control">
            </div>
            <div class="form-group">
                <label for="preco">Preço (R$)</label>
                <input type="text" id="preco" name="preco_${i + 1}" class="form-control" placeholder="R$ 0,00" oninput="formatarPreco(this)">
            </div>
            <div class="mb-3">
                <label for="">Imagem - ${i + 1}</label>
                <input type="text" name="imagem_${i + 1}" class="form-control">
            </div>
            <input type="hidden" id="preco_real_${i + 1}" name="preco_real_${i + 1}">
            `;
            presenteFields.appendChild(newForm);
        }
    }

    // Chama a função ao carregar a página
    window.onload = updateForms;

    // Função para formatar o preço e passar para um campo oculto
    function formatarPreco(element) {
        let valor = element.value;

        // Remove tudo que não for número ou vírgula
        valor = valor.replace(/[^\d,]/g, '');

        // Se o valor tiver mais de dois dígitos, insere a vírgula antes dos dois últimos números
        if (valor.length > 2) {
            valor = valor.replace(/(\d{1,})(\d{2})$/, '$1,$2');
        }

        // Adiciona ponto como separador de milhar
        valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

        // Coloca "R$" no começo e atribui o valor formatado
        element.value = 'R$ ' + valor;

        // Passa o valor formatado para o campo oculto
        const hiddenField = document.getElementById('preco_real_' + element.name.split('_')[1]);
        hiddenField.value = valor.replace(/[^\d,]/g, '').replace(',', '.'); // remove formatação e usa ponto como separador decimal
    }
</script>