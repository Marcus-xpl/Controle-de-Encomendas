# 📄 Documentação Técnica – Sistema de Gerenciamento de Encomendas

Este é um sistema de gerenciamento de encomendas desenvolvido com **HTML**, **CSS**, **JavaScript** e **PHP.** 
permite que os usuários adicionem, visualizem e excluam encomendas, mantendo um registro dinâmico e atualizado de todas as transações no sistema.

## ⚙️ Tecnologias Utilizadas:  

| Tecnologia  | Finalidade                                          |
|-------------|-----------------------------------------------------|
| HTML5       | Estrutura da página                                 |
| CSS3        | Estilização da interface                            |
| JavaScript  | Lógica e interatividade com o front-end             |
| PHP         | Backend para adicionar, listar e deletar encomendas |
| MySQL       | Banco de dados para armazenar encomendas            |

## 🧱 Componentes do Projeto:  

- `<form id="encomendaForm">` – Formulário para adicionar novas encomendas.  
- `<input>` – Campos para inserir nome do cliente, produto e quantidade.  
- `<ul id="listaEncomendas">` – Lista onde as encomendas são exibidas dinamicamente.  
- `.container` – Container principal que organiza o layout.  
- `.button` – Botão para adicionar e excluir encomendas.

### Funções JavaScript:

- `encomendaForm.addEventListener('submit')` – Captura o envio do formulário para adicionar uma nova encomenda.  
- `listarEncomendas()` – Recupera as encomendas do backend e as exibe na página.  
- `deletarEncomenda()` – Deleta uma encomenda do sistema via requisição DELETE.

### Objetivo  
Fazer um sistema de gerenciamento simples para controlar encomendas de clientes. O objetivo é fornecer uma interface intuitiva e fácil de usar para adicionar e excluir registros.

## 🧩 Desafios Enfrentados:  

| Desafio                                                  | Solução Aplicada                                                                     |
|----------------------------------------------------------|--------------------------------------------------------------------------------------|
| Gerenciar e atualizar a lista de encomendas dinamicamente| Uso de `fetch` para requisições assíncronas e `JSON` para manipulação de dados.      |
| Interagir com o banco de dados para adicionar e excluir registros | Implementação de endpoints em PHP para manipular dados no banco MySQL.      |
| Garantir que o formulário e a lista de encomendas sejam atualizados sem recarregar a página | Manipulação do DOM com JavaScript para renderização dinâmica.              |

