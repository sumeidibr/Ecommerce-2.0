<?php
session_start();

// Simulação de carrinho - em produção, os itens virão da sessão
// Exemplo de estrutura: $_SESSION['carrinho'] = [ ['id'=>1,'nome'=>'Samsung','preco'=>12500,'quantidade'=>2], ... ]

if (!isset($_SESSION['carrinho'])) {
    // Para demo, vamos popular com 2 produtos
    $_SESSION['carrinho'] = [
        ['id'=>1, 'nome'=>'Samsung Galaxy A23', 'preco'=>12500, 'quantidade'=>1],
        ['id'=>2, 'nome'=>'Forno Elétrico LG', 'preco'=>9750, 'quantidade'=>1]
    ];
}

$carrinho = $_SESSION['carrinho'];

// Calcular total
$total = 0;
foreach($carrinho as $item){
    $total += $item['preco'] * $item['quantidade'];
}
?>

<?php include('includes/header.php'); ?>

<div class="container mt-5">
    <h2>Seu Carrinho</h2>

    <?php if(count($carrinho) === 0): ?>
        <p>Seu carrinho está vazio.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço Unitário (MT)</th>
                    <th>Quantidade</th>
                    <th>Subtotal (MT)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($carrinho as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nome']) ?></td>
                        <td><?= number_format($item['preco'], 2) ?></td>
                        <td><?= $item['quantidade'] ?></td>
                        <td><?= number_format($item['preco'] * $item['quantidade'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Total: <?= number_format($total, 2) ?> MT</h4>

        <a href="checkout.php" class="btn btn-success btn-lg mt-3">Finalizar Compra</a>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
