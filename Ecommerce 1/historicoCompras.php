<?php
session_start();

// Simulação de histórico de compras do cliente
$historico = [
  [
    'pedido_id' => 101,
    'data' => '2025-06-10',
    'produtos' => [
      ['nome' => 'Samsung Galaxy A23', 'quantidade' => 1, 'preco' => 12500],
      ['nome' => 'Forno Elétrico LG', 'quantidade' => 1, 'preco' => 9750]
    ],
    'total' => 22250,
    'status' => 'Entregue'
  ],
  [
    'pedido_id' => 102,
    'data' => '2025-06-05',
    'produtos' => [
      ['nome' => 'iPhone 11', 'quantidade' => 1, 'preco' => 39000]
    ],
    'total' => 39000,
    'status' => 'Cancelado'
  ],
  [
    'pedido_id' => 103,
    'data' => '2025-05-28',
    'produtos' => [
      ['nome' => 'Geladeira Consul', 'quantidade' => 1, 'preco' => 18500]
    ],
    'total' => 18500,
    'status' => 'Em trânsito'
  ],
];
?>

<?php include('includes/header.php'); ?>

<div class="container mt-5">
  <h2>Histórico de Compras</h2>

  <?php if(empty($historico)): ?>
    <p>Você ainda não realizou nenhuma compra.</p>
  <?php else: ?>
    <?php foreach($historico as $pedido): ?>
      <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <strong>Pedido #<?= $pedido['pedido_id'] ?></strong>
          <span class="badge 
            <?= 
              $pedido['status'] === 'Entregue' ? 'bg-success' : 
              ($pedido['status'] === 'Cancelado' ? 'bg-danger' : 'bg-warning text-dark')
            ?>">
            <?= $pedido['status'] ?>
          </span>
        </div>
        <div class="card-body">
          <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($pedido['data'])) ?></p>

          <ul>
            <?php foreach($pedido['produtos'] as $item): ?>
              <li><?= $item['nome'] ?> x <?= $item['quantidade'] ?> — <?= number_format($item['preco'] * $item['quantidade'], 2) ?> MT</li>
            <?php endforeach; ?>
          </ul>

          <p><strong>Total:</strong> <?= number_format($pedido['total'], 2) ?> MT</p>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
