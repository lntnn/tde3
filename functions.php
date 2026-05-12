<?php
// Funções reutilizáveis para leitura, escrita e operações de dados usando PostgreSQL.

// Configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_petshop');  
define('DB_USER', 'postgres');    
define('DB_PASS', '1234');   

// Retorna uma conexão PDO com o banco de dados.
function getDbConnection() {
    try {
        $dsn = "pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}

function readData() {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT id, nome, categoria, preco, quantidade FROM produtos ORDER BY id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createProduct($nome, $categoria, $preco, $quantidade) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, categoria, preco, quantidade) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$nome, $categoria, $preco, $quantidade]);
}

function updateProduct($id, $nome, $categoria, $preco, $quantidade) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, categoria = ?, preco = ?, quantidade = ? WHERE id = ?");
    return $stmt->execute([$nome, $categoria, $preco, $quantidade, $id]);
}

function deleteProduct($id) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    return $stmt->execute([$id]);
}

function findRecordById($id) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT id, nome, categoria, preco, quantidade FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function redirectWithMessage($location, $message, $type = 'success') {
    header('Location: ' . $location . '?message=' . urlencode($message) . '&type=' . urlencode($type));
    exit;
}
