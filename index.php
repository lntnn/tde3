<?php
require_once 'functions.php';

// Lê os registros atuais do arquivo JSON.
$records = readData();

// Captura mensagens de feedback enviadas por query string.
$message = $_GET['message'] ?? '';
$type = $_GET['type'] ?? 'success';
?>

<?php include 'header.php'; ?>

<section class="content-card">
    <div class="page-title">
        <h2>Produtos em Estoque</h2>
        <p>Visualize, edite ou exclua os produtos do pet shop.</p>
    </div>

    <!-- Exibe mensagem de sucesso ou erro quando disponível -->
    <?php if ($message): ?>
        <div class="alert <?php echo $type === 'error' ? 'alert-error' : 'alert-success'; ?>">
            <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($records)): ?>
                    <!-- Mensagem exibida quando não há produtos cadastrados -->
                    <tr>
                        <td colspan="6">Nenhum produto cadastrado. Use o botão "Cadastrar" para adicionar um novo produto.</td>
                    </tr>
                <?php else: ?>
                    <!-- Lista cada registro em uma linha da tabela -->
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($record['nome'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($record['categoria'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>R$ <?php echo number_format($record['preco'] ?? 0, 2, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($record['quantidade'] ?? 0, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a class="btn btn-small btn-secondary" href="edit.php?id=<?php echo urlencode($record['id']); ?>">Editar</a>
                                <a class="btn btn-small btn-danger" href="delete.php?id=<?php echo urlencode($record['id']); ?>" onclick="return confirmDelete(<?php echo htmlspecialchars($record['id'], ENT_QUOTES, 'UTF-8'); ?>)">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'footer.php'; ?>
