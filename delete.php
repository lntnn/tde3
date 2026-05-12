<?php
require_once 'functions.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    redirectWithMessage('index.php', 'ID inválido.', 'error');
}

if (deleteProduct($id)) {
    redirectWithMessage('index.php', 'Deletado com sucesso.');
} else {
    redirectWithMessage('index.php', 'Erro ao deletar.', 'error');
}
