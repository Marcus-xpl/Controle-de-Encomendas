<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');  // Permite que o front-end faça requisições para este servidor

$servername = "localhost";
$username = "root";  // Padrão do XAMPP
$password = "";      // Geralmente vazio no XAMPP
$dbname = "encomendas";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Adiciona uma nova encomenda
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['nome'], $data['produto'], $data['quantidade'])) {
        echo json_encode(['error' => 'Dados incompletos!']);
        exit;
    }

    $nome = $conn->real_escape_string($data['nome']);
    $produto = $conn->real_escape_string($data['produto']);
    $quantidade = (int)$conn->real_escape_string($data['quantidade']);

    $sql = "INSERT INTO encomenda (nome, produto, quantidade) VALUES ('$nome', '$produto', $quantidade)";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Encomenda adicionada com sucesso!']);
    } else {
        echo json_encode(['error' => 'Erro ao adicionar encomenda: ' . $conn->error]);
    }
}
// Lista todas as encomendas
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM encomendas";
    $result = $conn->query($sql);
    $encomendas = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $encomendas[] = $row;
        }
    }
    echo json_encode($encomendas);
}
// Deleta uma encomenda
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $nome = $conn->real_escape_string($data['nome']);
    $produto = $conn->real_escape_string($data['produto']);
    $quantidade = (int)$conn->real_escape_string($data['quantidade']);

    // Query para deletar a encomenda
    $sql = "DELETE FROM encomendas WHERE nome='$nome' AND produto='$produto' AND quantidade=$quantidade";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Encomenda deletada com sucesso!']);
    } else {
        echo json_encode(['error' => 'Erro ao deletar encomenda: ' . $conn->error]);
    }
}

$conn->close();
?>
