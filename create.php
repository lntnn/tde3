<?php
// Inclui o arquivo "functions.php" que contém funções reutilizáveis para ler, gravar e redirecionar dados.
require_once 'functions.php';

// Array para armazenar mensagens de erro de validação.
$errors = [];

// Variáveis iniciais para os campos do formulário.
$nome = '';
$categoria = '';
$preco = '';
$quantidade = '';

// Verifica se a requisição foi feita via POST, ou seja, se o formulário foi enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura o valor do campo "name" enviado pelo formulário e remove espaços extras.
    $nome = trim($_POST['name'] ?? '');
    // Captura o valor do campo "category" enviado pelo formulário.
    $categoria = trim($_POST['category'] ?? '');
    // Captura o valor do campo "price" enviado pelo formulário.
    $preco = trim($_POST['price'] ?? '');
    // Captura o valor do campo "quantity" enviado pelo formulário.
    $quantidade = trim($_POST['quantity'] ?? '');

    // Validação do campo Nome do Produto: obrigatório e não vazio.
    if ($nome === '') {
        $errors[] = 'O campo Nome do Produto é obrigatório.';
    }

    // Validação do campo Categoria: obrigatório e não vazio.
    if ($categoria === '') {
        $errors[] = 'O campo Categoria é obrigatório.';
    }

    // Validação do campo Preço: obrigatório, numérico e não negativo.
    if ($preco === '') {
        $errors[] = 'O campo Preço é obrigatório.';
    } elseif (!is_numeric($preco) || $preco < 0) {
        $errors[] = 'O preço deve ser um número válido e positivo.';
    }

    // Validação do campo Quantidade: obrigatório, numérico e não negativo.
    if ($quantidade === '') {
        $errors[] = 'O campo Quantidade é obrigatório.';
    } elseif (!is_numeric($quantidade) || $quantidade < 0) {
        $errors[] = 'A quantidade deve ser um número válido e positivo.';
    }

    // Se não houver erros de validação, salva o produto.
    if (empty($errors)) {
        // Lê os registros existentes do arquivo JSON ou do armazenamento configurado.
        $records = readData();

        // Cria um novo registro com os dados enviados pelo formulário.
        $newRecord = [
            'id' => getNewId($records), // Gera um novo ID exclusivo com base nos registros atuais.
            'nome' => $nome,
            'categoria' => $categoria,
            'preco' => (float)$preco, // Converte o preço para float.
            'quantidade' => (int)$quantidade, // Converte a quantidade para inteiro.
        ];

        // Adiciona o novo registro ao array de registros.
        $records[] = $newRecord;

        // Salva os registros atualizados no arquivo JSON ou no armazenamento.
        saveData($records);

        // Redireciona para a página principal exibindo mensagem de sucesso.
        redirectWithMessage('index.php', 'Produto cadastrado com sucesso.');
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

    <!-- Exibe mensagens de erro se houver validação falha -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <!-- Exibe cada erro com escape seguro para evitar XSS -->
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Formulário de cadastro de produto -->
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
