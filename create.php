<?php
require_once 'functions.php';

$errors = [];
$nome = '';
$categoria = '';
$preco = '';
$quantidade = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['name'] ?? '');
    $categoria = trim($_POST['category'] ?? '');
    $preco = trim($_POST['price'] ?? '');
    $quantidade = trim($_POST['quantity'] ?? '');

    if ($nome === '') $errors[] = 'Nome obrigatório.';
    if ($categoria === '') $errors[] = 'Categoria obrigatória.';
    if ($preco === '') $errors[] = 'Preço obrigatório.';
    elseif (!is_numeric($preco) || $preco < 0) $errors[] = 'Preço inválido.';
    if ($quantidade === '') $errors[] = 'Quantidade obrigatória.';
    elseif (!is_numeric($quantidade) || $quantidade < 0) $errors[] = 'Quantidade inválida.';

    if (empty($errors)) {
        if (createProduct($nome, $categoria, $preco, $quantidade)) {
            redirectWithMessage('index.php', 'Produto cadastrado com sucesso.');
        } else {
            $errors[] = 'Erro ao salvar.';
        }
    }
}
?>

<?php include 'header.php'; ?>

<!-- Início do conteúdo principal da página de cadastro -->
<section class="content-card">
    <div class="page-title">
        <h2>Cadastrar Novo Produto</h2>
        <p>Preencha o formulário abaixo para adicionar um novo produto ao pet shop.</p>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" action="create.php">
        <div class="form-group">
            <label for="name">Nome do Produto</label>
            <input
                type="text"
                id="name"
                name="name"
                placeholder="Ex: Ração para Gatos"
                value="<?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?>"
            >
        </div>

        <div class="form-group">
            <label for="category">Categoria</label>
            <select id="category" name="category">
                <option value="">Selecione uma categoria</option>
                <option value="Alimentos" <?php echo $categoria === 'Alimentos' ? 'selected' : ''; ?>>Alimentos</option>
                <option value="Brinquedos" <?php echo $categoria === 'Brinquedos' ? 'selected' : ''; ?>>Brinquedos</option>
                <option value="Acessórios" <?php echo $categoria === 'Acessórios' ? 'selected' : ''; ?>>Acessórios</option>
                <option value="Higiene" <?php echo $categoria === 'Higiene' ? 'selected' : ''; ?>>Higiene</option>
                <option value="Medicamentos" <?php echo $categoria === 'Medicamentos' ? 'selected' : ''; ?>>Medicamentos</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Preço (R$)</label>
            <input
                type="number"
                id="price"
                name="price"
                placeholder="Ex: 49.90"
                step="0.01"
                min="0"
                value="<?php echo htmlspecialchars($preco, ENT_QUOTES, 'UTF-8'); ?>"
            >
        </div>

        <div class="form-group">
            <label for="quantity">Quantidade em Estoque</label>
            <input
                type="number"
                id="quantity"
                name="quantity"
                placeholder="Ex: 10"
                min="0"
                value="<?php echo htmlspecialchars($quantidade, ENT_QUOTES, 'UTF-8'); ?>"
            >
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Salvar Produto</button>
            <a class="btn btn-secondary" href="index.php">Cancelar</a>
        </div>
    </form>
</section>

<?php include 'footer.php'; ?>
