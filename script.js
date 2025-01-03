document.getElementById('encomendaForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const nome = document.getElementById('nome').value;
    const produto = document.getElementById('produto').value;
    const quantidade = document.getElementById('quantidade').value;

    const encomenda = { nome, produto, quantidade };

    fetch('encomendas.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(encomenda),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erro na requisição: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Resposta do servidor:', data);
        if (data.message) {
            // Recarrega a lista de encomendas após adicionar
            listarEncomendas();
        }
    })
    .catch(error => {
        console.error('Erro ao adicionar encomenda:', error);
    });
});

// Função para listar as encomendas
function listarEncomendas() {
    fetch('encomendas.php')
        .then(response => response.json())
        .then(encomendas => {
            const lista = document.getElementById('listaEncomendas');
            lista.innerHTML = ''; // Limpa a lista antes de adicionar novos itens

            encomendas.forEach(encomenda => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <span><i class="fas fa-box"></i> ${encomenda.nome} - ${encomenda.produto} (${encomenda.quantidade})</span>
                    <button onclick="deletarEncomenda('${encomenda.nome}', '${encomenda.produto}', ${encomenda.quantidade})">Deletar</button>
                `;
                lista.appendChild(li);
            });
        })
        .catch(error => console.error('Erro ao listar encomendas:', error));
}

// Função para deletar uma encomenda
function deletarEncomenda(nome, produto, quantidade) {
    const encomenda = { nome, produto, quantidade };
    
    fetch('encomendas.php', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(encomenda),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        listarEncomendas(); // Atualiza a lista de encomendas após deletar
    })
    .catch((error) => {
        console.error('Erro ao deletar a encomenda:', error.message);
    });
}

// Chama a função listarEncomendas ao carregar a página
listarEncomendas();
