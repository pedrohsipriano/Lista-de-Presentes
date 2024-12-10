<h1>Cadastrar Lista de Presentes</h1>
<form action="?page=salvar-lista" method="POST" id="listaForm">
    <input type="hidden" name="acao" value="cadastrar">
    <div class="mb-3">
        <label for="">Quantas Listas de Presentes?</label>
        <input type="number" id="quantidade_listas" name="quantidade_listas" class="form-control" value="1"
            min="1" max="10" onchange="updateForms()">
    </div>
    <div id="listaFields">
        <!-- Aqui serão gerados os formulários das listas de presentes -->
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success footer">Enviar</button>
    </div>
</form>
<script>
    // Função para adicionar os formulários automaticamente
function updateForms() {
    const quantidadeListas = document.getElementById('quantidade_listas').value;
    const listaFields = document.getElementById('listaFields');
    listaFields.innerHTML = ''; // Limpa os campos anteriores

    for (let i = 0; i < quantidadeListas; i++) {
        const newForm = document.createElement('div');
        newForm.classList.add('lista-form');

        newForm.innerHTML = `
            <div class="mb-3">
                <label for="">Nome da Lista de Presentes ${i + 1}</label>
                <input type="text" name="nome_lista_${i + 1}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Descrição da Lista de Presentes ${i + 1}</label>
                <input type="text" name="descricao_lista_${i + 1}" class="form-control" required>
            </div>`;
        listaFields.appendChild(newForm);
    }
}

// Chama a função ao carregar a página
window.onload = updateForms;

</script>