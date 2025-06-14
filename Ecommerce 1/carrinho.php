<?php
session_start();

$carrinho = $_SESSION['carrinho'] ?? [];

// Calcular total
$total = 0;
foreach ($carrinho as $item) {
    $total += $item['preco'] * $item['quantidade'];
}
?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Carrinho de Compras - Gordanda Services</title>
  <style>
    /* Reset básico */
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0; padding: 0;
      background: #f4f6f8;
      color: #333;
    }
    .container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 0 15px;
    }
    header.header {
      background: #007bff;
      color: white;
      padding: 20px 0;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    header.header h1 {
      margin: 0;
      font-weight: 700;
      font-size: 28px;
    }
    header.header nav {
      margin-top: 10px;
    }
    header.header nav a {
      color: white;
      text-decoration: none;
      margin-right: 20px;
      font-weight: 600;
      transition: color 0.3s ease;
      font-size: 16px;
    }
    header.header nav a.active,
    header.header nav a:hover {
      text-decoration: underline;
      color: #dbe9ff;
    }

    main.container h2.title {
      margin-bottom: 25px;
      font-size: 28px;
      font-weight: 700;
      color: #222;
    }

    .empty-cart {
      font-size: 18px;
      text-align: center;
      padding: 50px 0;
      color: #666;
    }

    /* Carrinho cards */
    .cart-list {
      display: flex;
      flex-direction: column;
      gap: 20px;
      margin-bottom: 30px;
    }

    .cart-item {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
      transition: box-shadow 0.3s ease;
    }
    .cart-item:hover {
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }

    .cart-item-info {
      flex: 2 1 300px;
    }
    .cart-item-info h3 {
      margin: 0 0 8px 0;
      font-size: 20px;
      color: #007bff;
    }
    .cart-item-info p {
      margin: 0;
      font-size: 14px;
      color: #555;
    }

    .cart-item-price,
    .cart-item-qty,
    .cart-item-subtotal {
      flex: 1 1 120px;
      text-align: center;
      font-size: 16px;
      font-weight: 600;
      color: #333;
    }

    .cart-item-label {
      font-weight: 400;
      font-size: 12px;
      color: #999;
      margin-bottom: 6px;
    }

    /* Total e botão */
    .cart-total {
      font-size: 24px;
      font-weight: 700;
      text-align: right;
      margin-bottom: 30px;
      color: #222;
    }

    .btn-success {
      background-color: #28a745;
      color: white;
      padding: 15px 25px;
      font-size: 18px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      display: inline-block;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }
    .btn-success:hover {
      background-color: #1e7e34;
    }

    /* Responsivo */
    @media(max-width: 600px) {
      .cart-item {
        flex-direction: column;
        align-items: flex-start;
      }
      .cart-item-price,
      .cart-item-qty,
      .cart-item-subtotal {
        text-align: left;
        flex: 1 1 100%;
      }
      .cart-total {
        text-align: left;
      }
    }

    footer.footer {
      text-align: center;
      padding: 20px 0;
      background: #007bff;
      color: white;
      margin-top: 50px;
      font-weight: 600;
    }
  </style>
</head>
<body>

  <header class="header">
    <div class="container">
      <h1>Gordanda Services</h1>
      <nav>
        <a href="index.php">Home</a>
        <a href="carrinho.php" class="active">Carrinho</a>
        <a href="checkout.php">Finalizar Compra</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <h2 class="title">Seu Carrinho</h2>

    <?php if (count($carrinho) === 0): ?>
      <p class="empty-cart">Seu carrinho está vazio.</p>
    <?php else: ?>
      <div class="cart-list">
        <?php foreach ($carrinho as $item): ?>
          <div class="cart-item">
            <div class="cart-item-info">
              <h3><?= htmlspecialchars($item['nome']) ?></h3>
            </div>

            <div class="cart-item-price">
              <div class="cart-item-label">Preço Unitário</div>
              <?= number_format($item['preco'], 2, ',', '.') ?> MT
            </div>

            <div class="cart-item-qty">
              <div class="cart-item-label">Quantidade</div>
              <?= (int)$item['quantidade'] ?>
            </div>

            <div class="cart-item-subtotal">
              <div class="cart-item-label">Subtotal</div>
              <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?> MT
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="cart-total">
        Total: <?= number_format($total, 2, ',', '.') ?> MT
      </div>

      <a href="pagamento.php" class="btn-success">Finalizar Compra</a>
    <?php endif; ?>
  </main>

  <footer class="footer">
    <div class="container">
      &copy; <?= date('Y') ?> Gordanda Services. Todos os direitos reservados.
    </div>
  </footer>

</body>
</html>
