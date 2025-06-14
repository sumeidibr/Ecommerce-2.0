<?php
session_start();
include('includes/header.php'); // se precisar carregar cabeçalho genérico
require 'db.php'; // conexão com banco

// Puxar categorias
$stmtCat = $pdo->query("SELECT * FROM categorias");
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// Produtos por categoria (5 por categoria)
$produtosPorCategoria = [];
foreach ($categorias as $cat) {
    $stmtProd = $pdo->prepare("SELECT * FROM produtos WHERE categoria_id = ? LIMIT 5");
    $stmtProd->execute([$cat['id']]);
    $produtosPorCategoria[$cat['id']] = $stmtProd->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gordanda Services - Home</title>
  <link rel="stylesheet" href="/Ecommerce 1/assets/css/style.css" />
</head>
<body>

<?php if (isset($_SESSION['usuario'])): ?>
  <div class="container">
    <div class="welcome">
      👋 Olá, <strong><?= htmlspecialchars($_SESSION['usuario']['nome']) ?></strong>! Bem-vindo(a) à Gordanda Services.
    </div>
  </div>
<?php endif; ?>

<div class="container banner">
  <img src="assets/img/banner.jpg" alt="Banner promocional" />
</div>

<div class="container">
  <h2 class="section-title">Categorias</h2>
  <div class="categories">
    <?php foreach ($categorias as $cat): ?>
      <div class="category-card" onclick="window.location.href='produtos.php?categoria=<?= $cat['id'] ?>'">
        <img src="assets/img/<?= strtolower($cat['nome']) ?>.jpg" alt="<?= htmlspecialchars($cat['nome']) ?>" />
        <h4><?= htmlspecialchars($cat['nome']) ?></h4>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="container">
  <?php foreach ($categorias as $cat): ?>
    <div class="carousel-container">
      <div class="carousel-title"><?= htmlspecialchars($cat['nome']) ?></div>
      <div class="carousel" id="carousel-<?= $cat['id'] ?>">
       <?php foreach ($produtosPorCategoria[$cat['id']] as $prod): ?>
  <a href="detalheProduto.php?id=<?= $prod['id'] ?>" class="product-card" style="text-decoration:none; color:inherit;">
    <img src="uploads/<?= htmlspecialchars($prod['imagem']) ?>" alt="<?= htmlspecialchars($prod['nome']) ?>" />
    <div class="product-name"><?= htmlspecialchars($prod['nome']) ?></div>
    <div class="product-price"><?= number_format($prod['preco'], 2, ',', '.') ?> MT</div>
  </a>
<?php endforeach; ?>

      </div>
      <div class="carousel-btns">
        <button onclick="scrollCarousel('carousel-<?= $cat['id'] ?>', -300)">◀</button>
        <button onclick="scrollCarousel('carousel-<?= $cat['id'] ?>', 300)">▶</button>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<script>
  function scrollCarousel(id, distance) {
    const carousel = document.getElementById(id);
    carousel.scrollBy({ left: distance, behavior: 'smooth' });
  }
</script>

<?php include('includes/footer.php'); ?>

</body>
</html>
