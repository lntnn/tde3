<?php
require_once 'functions.php';
$id = $_GET['id'] ?? null;

if (!$id) {
    redirectWithMessage('index.php', 'ID inválido para exclusão.', 'error');
}

$records = readData();
$found = false;
foreach ($records as $index => $item) {
    if ((int)$item['id'] === (int)$id) {
        $found = true;
        array_splice($records, $index, 1);
        break;
    }
}

if (!$found) {
    redirectWithMessage('index.php', 'Registro não encontrado para exclusão.', 'error');
}

saveData($records);
redirectWithMessage('index.php', 'Registro excluído com sucesso.');
