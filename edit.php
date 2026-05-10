<?php
require_once 'functions.php';

// Lê todos os registros existentes para encontrar o item a ser editado.
$records = readData();

// Captura o ID enviado por query string.
$id = $_GET['id'] ?? null;

// Busca o registro correspondente ao ID informado.
$record = $id ? findRecordById($records, $id) : null;

// Se não houver registro com esse ID, redireciona com erro.
if (!$record) {
    redirectWithMessage('index.php', 'Registro não encontrado.', 'error');
}

// Inicializa as variáveis que serão exibidas no formulário.
$errors = [];
$name = $record['name'];
$category = $record['category'];
$price = $record['price'];
$quantity = $record['quantity'];

// Executa a atualização quando o formulário for enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Limpa espaços em branco ao redor dos valores enviados.
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $quantity = trim($_POST['quantity'] ?? '');

    // Validação dos campos do formulário.
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

    // Se não houver erros, atualiza o registro e salva os dados.
    if (empty($errors)) {
        foreach ($records as &$item) {
            if ((int)$item['id'] === (int)$id) {
                $item['name'] = $name;
                $item['category'] = $category;
                $item['price'] = (float)$price;
                $item['quantity'] = (int)$quantity;
                break;
            }
        }
        unset($item); // Limpa referência após uso.

        saveData($records);
        redirectWithMessage('index.php', 'Produto atualizado com sucesso.');
    }
}
?>

<?php include 'header.php'; ?>

<section class="content-card">
    <div class="page-title">
        <h2>Editar Produto</h2>
        <p>Atualize as informações do produto selecionado.</p>
    </div>

    <!-- Exibe mensagens de erro se a validação falhar -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Formulário para editar o produto -->
    <form method="post" action="edit.php?id=<?php echo urlencode($id); ?>">
        <div class="form-group">
            <label for="name">Nome do Produto</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
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
            <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($price, ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="form-group">
            <label for="quantity">Quantidade em Estoque</label>
            <input type="number" id="quantity" name="quantity" min="0" value="<?php echo htmlspecialchars($quantity, ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Atualizar Produto</button>
            <a class="btn btn-secondary" href="index.php">Cancelar</a>
        </div>
    </form>
</section>

<?php include 'footer.php'; ?>
