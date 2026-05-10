<?php
// Cabeçalho compartilhado entre páginas para manter o mesmo layout.
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Shop - Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar">
    <div class="container header-inner">
        <div>
            <h1>🐾 Pet Shop Manager</h1>
            <p>Gerenciamento de produtos para pet shop</p>
        </div>
        <nav>
            <!-- Links de navegação para as páginas principais do sistema -->
            <a href="index.php">Listar</a>
            <a href="create.php">Cadastrar</a>
        </nav>
    </div>
</header>

<!-- Início do conteúdo principal exibido em cada página -->
<main class="container">
