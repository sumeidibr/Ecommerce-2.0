<?php
session_start();

$carrinho = $_SESSION['carrinho'] ?? [];

$total = 0;
foreach($carrinho as $item){
    $total += $item['preco'] * $item['quantidade'];
}

// Simulação do processamento de pagamento
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metodo = $_POST['pagamento'] ?? '';
    if (in_array($metodo, ['mpesa', 'emola', 'paypal'])) {
        $mensagem = "Pagamento via " . strtoupper($metodo) . " confirmado! Total pago: " . number_format($total, 2) . " MT.";
        // Limpa o carrinho após "pagamento"
        $_SESSION['carrinho'] = [];
    } else {
        $mensagem = "Método de pagamento inválido.";
    }
}
?>

<?php include('includes/header.php'); ?>

<div class="container mt-5">
    <h2>Checkout</h2>

    <?php if ($mensagem): ?>
        <div class="alert alert-success">
            <?= $mensagem ?>
        </div>
        <a href="index.php" class="btn btn-primary">Voltar para a loja</a>
    <?php elseif (count($carrinho) === 0): ?>
        <p>Seu carrinho está vazio.</p>
        <a href="index.php" class="btn btn-primary">Voltar para a loja</a>
    <?php else: ?>
        <h4>Resumo do Pedido</h4>
        <ul class="list-group mb-4">
            <?php foreach($carrinho as $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($item['nome']) ?> x <?= $item['quantidade'] ?>
                    <span><?= number_format($item['preco'] * $item['quantidade'], 2) ?> MT</span>
                </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Total</strong>
                <strong><?= number_format($total, 2) ?> MT</strong>
            </li>
        </ul>

        <form method="POST" action="">
            <h5>Selecione o método de pagamento:</h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pagamento" id="mpesa" value="mpesa" required>
                <label class="form-check-label" for="mpesa">M-Pesa</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pagamento" id="emola" value="emola" required>
                <label class="form-check-label" for="emola">eMola</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pagamento" id="paypal" value="paypal" required>
                <label class="form-check-label" for="paypal">PayPal</label>
            </div>

            <button type="submit" class="btn btn-success mt-3">Confirmar Pagamento</button>
        </form>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
