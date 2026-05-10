<?php
// Funções reutilizáveis para leitura, escrita e operações de dados.
function getDataFilePath() {
    return __DIR__ . '/data.json';
}

function readData() {
    $file = getDataFilePath();
    if (!file_exists($file)) {
        return [];
    }

    $json = file_get_contents($file);
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

function saveData(array $data) {
    $file = getDataFilePath();
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function getNewId(array $items) {
    $ids = array_column($items, 'id');
    return empty($ids) ? 1 : max($ids) + 1;
}

function findRecordById(array $items, $id) {
    foreach ($items as $item) {
        if ((int)$item['id'] === (int)$id) {
            return $item;
        }
    }
    return null;
}

function redirectWithMessage($location, $message, $type = 'success') {
    header('Location: ' . $location . '?message=' . urlencode($message) . '&type=' . urlencode($type));
    exit;
}
