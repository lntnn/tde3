<?php
// Cabeçalho compartilhado entre páginas para manter layout consistente.
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Simples em PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar">
    <div class="container header-inner">
        <div>
            <h1>CRUD Simples</h1>
            <p>Projeto em PHP puro com dados em arquivo JSON.</p>
        </div>
        <nav>
            <a href="index.php">Listar</a>
            <a href="create.php">Cadastrar</a>
        </nav>
    </div>
</header>
<main class="container">
