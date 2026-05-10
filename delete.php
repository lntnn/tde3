<?php
require_once 'functions.php';

// Captura o ID do registro enviado por query string.
$id = $_GET['id'] ?? null;

// Verifica se o ID é válido antes de tentar excluir.
if (!$id) {
    redirectWithMessage('index.php', 'ID inválido para exclusão.', 'error');
}

// Lê os registros do arquivo para localizar o item que será excluído.
$records = readData();
$found = false;
foreach ($records as $index => $item) {
    if ((int)$item['id'] === (int)$id) {
        $found = true;
        // Remove o registro do array mantendo os índices corretos.
        array_splice($records, $index, 1);
        break;
    }
}

// Se não encontrou o registro, notifica o usuário e redireciona.
if (!$found) {
    redirectWithMessage('index.php', 'Registro não encontrado para exclusão.', 'error');
}

// Salva o array atualizado após excluir o registro.
saveData($records);
redirectWithMessage('index.php', 'Registro excluído com sucesso.');
