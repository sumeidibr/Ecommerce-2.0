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
    *, *::before, *::after {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0; padding: 0;
      background: #f9fafb;
      color: #333;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      max-width: 1024px;
      margin: 40px auto 80px;
      padding: 0 20px;
      flex-grow: 1;
    }

    /* Header */
    header.header {
      background: #0056b3;
      color: white;
      padding: 24px 0;
      box-shadow: 0 4px 12px rgb(0 86 179 / 0.3);
      position: sticky;
      top: 0;
      z-index: 999;
    }

    header.header .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    header.header h1 {
      margin: 0;
      font-weight: 800;
      font-size: 28px;
      letter-spacing: 1px;
      user-select: none;
    }

    header.header nav a {
      color: white;
      text-decoration: none;
      margin-left: 20px;
      font-weight: 600;
      font-size: 16px;
      padding: 8px 12px;
      border-radius: 6px;
      transition: background-color 0.3s ease, color 0.3s ease;
      user-select: none;
    }

    header.header nav a:first-child {
      margin-left: 0;
    }

    header.header nav a.active,
    header.header nav a:hover {
      background: #cce4ff;
      color: #0056b3;
      text-decoration: none;
      font-weight: 700;
      box-shadow: 0 4px 8px rgb(0 86 179 / 0.2);
    }

    /* Main Título */
    main.container h2.title {
      margin-bottom: 30px;
      font-size: 32px;
      font-weight: 700;
      color: #222;
      letter-spacing: 0.02em;
      user-select: none;
    }

    /* Empty cart */
    .empty-cart {
      font-size: 20px;
      text-align: center;
      padding: 80px 0;
      color: #777;
      font-style: italic;
      user-select: none;
    }

    /* Lista de itens */
    .cart-list {
      display: flex;
      flex-direction: column;
      gap: 24px;
      margin-bottom: 40px;
    }

    /* Card item */
    .cart-item {
      background: white;
      padding: 24px 30px;
      border-radius: 14px;
      box-shadow: 0 8px 24px rgb(0 0 0 / 0.08);
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 30px;
      flex-wrap: wrap;
      transition: box-shadow 0.3s ease;
    }

    .cart-item:hover {
      box-shadow: 0 12px 36px rgb(0 0 0 / 0.15);
    }

    /* Info do produto */
    .cart-item-info {
      flex: 2 1 320px;
      min-width: 220px;
    }

    .cart-item-info h3 {
      margin: 0 0 10px 0;
      font-size: 22px;
      font-weight: 700;
      color: #0056b3;
      user-select: text;
    }

    .cart-item-info p {
      margin: 0;
      font-size: 15px;
      color: #555;
      user-select: none;
    }

    /* Preço, quantidade e subtotal */
    .cart-item-price,
    .cart-item-qty,
    .cart-item-subtotal {
      flex: 1 1 130px;
      text-align: center;
      font-size: 17px;
      font-weight: 600;
      color: #222;
      user-select: none;
    }

    .cart-item-label {
      font-weight: 500;
      font-size: 13px;
      color: #999;
      margin-bottom: 6px;
      user-select: none;
    }

    /* Total */
    .cart-total {
      font-size: 28px;
      font-weight: 800;
      text-align: right;
      margin-bottom: 40px;
      color: #222;
      letter-spacing: 0.03em;
      user-select: none;
    }

    /* Botão finalizar compra */
    .btn-success {
      background-color: #28a745;
      color: white;
      padding: 16px 32px;
      font-size: 20px;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      text-decoration: none;
      font-weight: 700;
      display: inline-block;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      user-select: none;
      box-shadow: 0 6px 12px rgb(40 167 69 / 0.4);
    }
    .btn-success:hover,
    .btn-success:focus {
      background-color: #1e7e34;
      box-shadow: 0 10px 24px rgb(30 126 52 / 0.6);
      outline: none;
      text-decoration: none;
      color: white;
    }

    /* Responsivo */
    @media(max-width: 700px) {
      .cart-item {
        flex-direction: column;
        align-items: flex-start;
      }
      .cart-item-price,
      .cart-item-qty,
      .cart-item-subtotal {
        text-align: left;
        flex: 1 1 100%;
        margin-top: 10px;
      }
      .cart-total {
        text-align: left;
      }
      header.header nav a {
        margin-left: 10px;
        padding: 6px 10px;
        font-size: 14px;
      }
    }

    /* Footer */
    footer.footer {
      text-align: center;
      padding: 24px 0;
      background: #0056b3;
      color: white;
      font-weight: 600;
      user-select: none;
    }
  </style>
</head>
<body>

  <?php

include('includes/header.php'); // cabeçalho genérico
require 'db.php'; // conexão
?>

  <main class="container">
    <h2 class="title">Seu Carrinho</h2>

    <?php if (count($carrinho) === 0): ?>
      <p class="empty-cart">Seu carrinho está vazio.</p>
    <?php else: ?>
      <div class="cart-list">
        <?php foreach ($carrinho as $item): ?>
          <div class="cart-item">
            <div class="cart-item-info">
              <h3><?=htmlspecialchars($item['nome']) ?></h3>
             
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

      <a href="pagamento.php" class="btn-success" role="button">Finalizar Compra</a>
    <?php endif; ?>
  </main>

  <footer class="footer">
    <div class="container">
      &copy; <?= date('Y') ?> Gordanda Services. Todos os direitos reservados.
    </div>
  </footer>

</body>
</html>
