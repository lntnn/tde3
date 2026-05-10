<?php
require_once 'functions.php';
$errors = [];
$name = '';
$category = '';
$price = '';
$quantity = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $quantity = trim($_POST['quantity'] ?? '');

    if ($name === '') {
        $errors[] = 'O campo Nome do Produto é obrigatório.';
    }
    if ($category === '') {
        $errors[] = 'O campo Categoria é obrigatório.';
    }
    if ($price === '') {
        $errors[] = 'O campo Preço é obrigatório.';
    } elseif (!is_numeric($price) || $price < 0) {
        $errors[] = 'O preço deve ser um número válido e positivo.';
    }
    if ($quantity === '') {
        $errors[] = 'O campo Quantidade é obrigatório.';
    } elseif (!is_numeric($quantity) || $quantity < 0) {
        $errors[] = 'A quantidade deve ser um número válido e positivo.';
    }

    if (empty($errors)) {
        $records = readData();
        $newRecord = [
            'id' => getNewId($records),
            'name' => $name,
            'category' => $category,
            'price' => (float)$price,
            'quantity' => (int)$quantity,
        ];
        $records[] = $newRecord;
        saveData($records);
        redirectWithMessage('index.php', 'Produto cadastrado com sucesso.');
    }
}
?>
<?php include 'header.php'; ?>
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
            <input type="text" id="name" name="name" placeholder="Ex: Ração para Gatos" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="form-group">
            <label for="category">Categoria</label>
            <select id="category" name="category">
                <option value="">Selecione uma categoria</option>
                <option value="Alimentos" <?php echo $category === 'Alimentos' ? 'selected' : ''; ?>>Alimentos</option>
                <option value="Brinquedos" <?php echo $category === 'Brinquedos' ? 'selected' : ''; ?>>Brinquedos</option>
                <option value="Acessórios" <?php echo $category === 'Acessórios' ? 'selected' : ''; ?>>Acessórios</option>
                <option value="Higiene" <?php echo $category === 'Higiene' ? 'selected' : ''; ?>>Higiene</option>
                <option value="Medicamentos" <?php echo $category === 'Medicamentos' ? 'selected' : ''; ?>>Medicamentos</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Preço (R$)</label>
            <input type="number" id="price" name="price" placeholder="Ex: 49.90" step="0.01" min="0" value="<?php echo htmlspecialchars($price, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="form-group">
            <label for="quantity">Quantidade em Estoque</label>
            <input type="number" id="quantity" name="quantity" placeholder="Ex: 10" min="0" value="<?php echo htmlspecialchars($quantity, ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Salvar Produto</button>
            <a class="btn btn-secondary" href="index.php">Cancelar</a>
        </div>
    </form>
</section>
<?php include 'footer.php'; ?>
