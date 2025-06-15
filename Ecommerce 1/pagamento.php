<?php
session_start();

$carrinho = $_SESSION['carrinho'] ?? [];

$total = 0;
foreach ($carrinho as $item) {
    $total += $item['preco'] * $item['quantidade'];
}

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metodo = $_POST['pagamento'] ?? '';
    if (in_array($metodo, ['mpesa', 'emola', 'paypal'])) {
        $mensagem = "✅ Pagamento via <strong>" . strtoupper($metodo) . "</strong> confirmado! Total pago: <strong>" . number_format($total, 2) . " MT</strong>.";
        $_SESSION['carrinho'] = [];
    } else {
        $mensagem = "❌ Método de pagamento inválido.";
    }
}
?>


<style>
  body {
    background: #f0f2f5;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .container {
    max-width: 700px;
    margin: 60px auto;
    background: white;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
  }

  h2 {
    font-size: 32px;
    color: #0056b3;
    margin-bottom: 20px;
  }

  h4 {
    font-size: 22px;
    margin-top: 30px;
    color: #222;
  }

  .list-group {
    list-style: none;
    padding: 0;
    margin: 20px 0;
  }

  .list-group-item {
    padding: 14px 18px;
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    font-size: 16px;
  }

  .form-check {
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .form-check-input {
    width: 18px;
    height: 18px;
    cursor: pointer;
  }

  .form-check-label {
    font-size: 16px;
    cursor: pointer;
  }

  .btn {
    background-color: #28a745;
    color: white;
    padding: 14px 28px;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #218838;
  }

  .alert {
    padding: 16px 20px;
    background-color: #e6f9ec;
    color: #155724;
    border: 1px solid #c3e6cb;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 16px;
  }

  a.btn-link {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    background: #0056b3;
    color: white;
    padding: 10px 24px;
    border-radius: 10px;
    font-weight: 600;
    transition: background 0.3s ease;
  }

  a.btn-link:hover {
    background: #003d80;
  }

  @media(max-width: 600px) {
    .container {
      margin: 20px;
      padding: 20px;
    }
  }
</style>

<div class="container">
  <h2>Pagamento</h2>

  <?php if ($mensagem): ?>
    <div class="alert">
      <?= $mensagem ?>
    </div>
    <a href="index.php" class="btn-link">Voltar para a Loja</a>

  <?php elseif (count($carrinho) === 0): ?>
    <p>Seu carrinho está vazio.</p>
    <a href="index.php" class="btn-link">Voltar para a Loja</a>

  <?php else: ?>
    <h4>Resumo do Pedido</h4>
    <ul class="list-group">
      <?php foreach ($carrinho as $item): ?>
        <li class="list-group-item">
          <?= htmlspecialchars($item['nome']) ?> x <?= (int)$item['quantidade'] ?>
          <span><?= number_format($item['preco'] * $item['quantidade'], 2) ?> MT</span>
        </li>
      <?php endforeach; ?>
      <li class="list-group-item" style="font-weight: bold;">
        Total
        <span><?= number_format($total, 2) ?> MT</span>
      </li>
    </ul>

    <form method="POST">
      <h4>Método de Pagamento</h4>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="pagamento" id="mpesa" value="mpesa" required>
        <label class="form-check-label" for="mpesa">M-Pesa</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="pagamento" id="emola" value="emola" required>
        <label class="form-check-label" for="emola">e-Mola</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="pagamento" id="paypal" value="paypal" required>
        <label class="form-check-label" for="paypal">PayPal</label>
      </div>

      <button type="submit" class="btn">Confirmar Pagamento</button>
    </form>
  <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
