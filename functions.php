<?php
// Funções reutilizáveis para leitura, escrita e operações de dados.

// Retorna o caminho absoluto do arquivo JSON de dados.
function getDataFilePath() {
    return __DIR__ . '/data.json';
}

// Lê o arquivo JSON de dados e retorna um array de registros.
// Se o arquivo não existir ou estiver vazio, retorna array vazio.
function readData() {
    $file = getDataFilePath();
    if (!file_exists($file)) {
        return [];
    }

    $json = file_get_contents($file);
    $data = json_decode($json, true);

    // Garante que o retorno seja sempre um array válido.
    return is_array($data) ? $data : [];
}

// Salva os dados no arquivo JSON usando formatação legível.
function saveData(array $data) {
    $file = getDataFilePath();
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Retorna o próximo ID livre com base nos IDs existentes.
function getNewId(array $items) {
    $ids = array_column($items, 'id');
    return empty($ids) ? 1 : max($ids) + 1;
}

// Procura um registro pelo seu ID e retorna o registro encontrado.
// Retorna null caso nenhum registro corresponda.
function findRecordById(array $items, $id) {
    foreach ($items as $item) {
        if ((int)$item['id'] === (int)$id) {
            return $item;
        }
    }
    return null;
}

// Redireciona para outra página passando uma mensagem via query string.
// A execução é interrompida após o redirecionamento.
function redirectWithMessage($location, $message, $type = 'success') {
    header('Location: ' . $location . '?message=' . urlencode($message) . '&type=' . urlencode($type));
    exit;
}
