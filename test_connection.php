<?php
require_once 'functions.php';

try {
    $pdo = getDbConnection();
    echo " Conexão com PostgreSQL bem-sucedida!<br>";

    $stmt = $pdo->query("SELECT COUNT(*) as total FROM produtos");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo " Total de produtos na tabela: " . $result['total'] . "<br>";

    if ($result['total'] > 0) {
        echo " Produtos encontrados:<br>";
        $produtos = readData();
        foreach ($produtos as $produto) {
            echo "- {$produto['nome']} (R$ {$produto['preco']})<br>";
        }
    }

} catch (PDOException $e) {
    echo " Erro na conexão: " . $e->getMessage();
}
?>