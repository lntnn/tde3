<?php
require_once 'functions.php';
$errors = [];
$name = '';
$email = '';
$phone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if ($name === '') {
        $errors[] = 'O campo Nome é obrigatório.';
    }
    if ($email === '') {
        $errors[] = 'O campo E-mail é obrigatório.';
    }
    if ($phone === '') {
        $errors[] = 'O campo Telefone é obrigatório.';
    }

    if (empty($errors)) {
        $records = readData();
        $newRecord = [
            'id' => getNewId($records),
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ];
        $records[] = $newRecord;
        saveData($records);
        redirectWithMessage('index.php', 'Registro cadastrado com sucesso.');
    }
}
?>
<?php include 'header.php'; ?>
<section class="content-card">
    <div class="page-title">
        <h2>Cadastrar Novo Registro</h2>
        <p>Preencha o formulário abaixo para adicionar um novo contato.</p>
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
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="form-group">
            <label for="phone">Telefone</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a class="btn btn-secondary" href="index.php">Voltar</a>
        </div>
    </form>
</section>
<?php include 'footer.php'; ?>
