<?php
session_start();
include('includes/header.php'); // cabeçalho genérico
require 'db.php'; // conexão

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

// Mapeamento de ícones por categoria
$iconMap = [
    'Roupas' => 't-shirt',
    'Eletrônicos' => 'device-mobile',
    'Casa' => 'house',
    'Livros' => 'book-open-text',
    'Beleza' => 'sparkle',
];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gordanda Services - Home</title>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: #f5f7fa;
      color: #333;
      line-height: 1.6;
    }
    .container {
      width: 100%;
      max-width: 1400px;
      margin: 0 auto 40px;
      padding-top: 20px;
    }
    .welcome {
      font-size: 1.25rem;
      background: #e0f2fe;
      border-left: 6px solid #3b82f6;
      padding: 15px 25px;
      border-radius: 8px;
      margin-bottom: 30px;
      color: #0369a1;
      font-weight: 600;
      user-select: none;
    }
    .banner img {
      width: 100%;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2);
      object-fit: cover;
      max-height: 500px;
      transition: transform 0.3s ease;
      cursor: pointer;
    }
    .banner img:hover {
      transform: scale(1.03);
    }
    .section-title {
      font-size: 2rem;
      color: #1e40af;
      margin-bottom: 20px;
      font-weight: 700;
      border-bottom: 3px solid #3b82f6;
      padding-bottom: 8px;
    }
    .categories {
      display: grid;
      grid-template-columns: repeat(auto-fit,minmax(160px,1fr));
      gap: 20px;
    }
    .category-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(59, 130, 246, 0.1);
      cursor: pointer;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px 10px;
      text-align: center;
    }
    .category-card:hover, .category-card:focus {
      box-shadow: 0 12px 25px rgba(59, 130, 246, 0.25);
      transform: translateY(-5px);
      outline: none;
    }
    .category-card i {
      font-size: 48px;
      color: #3b82f6;
      margin-bottom: 10px;
    }
    .category-card h4 {
      margin: 0;
      font-weight: 600;
      color: #1e40af;
      font-size: 1.1rem;
    }
    .carousel-container {
      margin-top: 40px;
    }
    .carousel-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 16px;
      color: #1e3a8a;
    }
    .carousel {
      display: flex;
      overflow-x: auto;
      scroll-behavior: smooth;
      gap: 15px;
      padding-bottom: 10px;
    }
    .carousel::-webkit-scrollbar {
      height: 8px;
    }
    .carousel::-webkit-scrollbar-thumb {
      background-color: #3b82f6;
      border-radius: 10px;
    }
    .carousel-btns {
      margin-top: 5px;
      text-align: right;
    }
    .carousel-btns button {
      background-color: #3b82f6;
      border: none;
      color: white;
      padding: 8px 14px;
      font-size: 1rem;
      border-radius: 9999px;
      cursor: pointer;
      margin-left: 10px;
      transition: background-color 0.3s;
    }
    .carousel-btns button:hover {
      background-color: #2563eb;
    }
    .product-card {
      flex: 0 0 180px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
      text-align: center;
      cursor: pointer;
      text-decoration: none;
      color: inherit;
      display: flex;
      flex-direction: column;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .product-card:hover, .product-card:focus {
      transform: translateY(-6px);
      box-shadow: 0 16px 35px rgba(0, 0, 0, 0.12);
      outline: none;
    }
    .product-card img {
      width: 100%;
      height: 140px;
      object-fit: cover;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }
    .product-name {
      font-weight: 600;
      font-size: 1rem;
      margin: 12px 10px 6px;
      flex-grow: 1;
    }
    .product-price {
      font-weight: 700;
      font-size: 1.1rem;
      color: #2563eb;
      margin-bottom: 14px;
    }
    .container_
    @media (max-width: 700px) {
      .carousel {
        gap: 10px;
      }
      .product-card {
        flex: 0 0 140px;
      }
      .product-card img {
        height: 110px;
      }
      .section-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

<?php if (isset($_SESSION['usuario'])): ?>
  <div class="container">
    <div class="welcome" role="alert" aria-live="polite">
      👋 Olá, <strong><?= htmlspecialchars($_SESSION['usuario']['nome']) ?></strong>! Bem-vindo(a) à GT Cash Store.
    </div>
  </div>
<?php endif; ?>
   
<div class="container banner">
  <img src="../Ecommerce 1/assets/img/pexel.jpg" alt="Banner promocional com ofertas especiais" />

</div>

<div class="container">
  <h2 class="section-title" id="categorias">Categorias</h2>
  <div class="categories" aria-labelledby="categorias">
    <?php foreach ($categorias as $cat): ?>
      <div class="category-card" tabindex="0" onclick="window.location.href='produtos.php?categoria=<?= $cat['id'] ?>'" onkeypress="if(event.key === 'Enter') window.location.href='produtos.php?categoria=<?= $cat['id'] ?>'">
        <i class="ph ph-<?= $iconMap[$cat['nome']] ?? 'cube' ?>"></i>
        <h4><?= htmlspecialchars($cat['nome']) ?></h4>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="container">
  <?php foreach ($categorias as $cat): ?>
    <section class="carousel-container" aria-labelledby="cat-<?= $cat['id'] ?>-title">
      <h3 class="carousel-title" id="cat-<?= $cat['id'] ?>-title"><?= htmlspecialchars($cat['nome']) ?></h3>
      <div class="carousel" id="carousel-<?= $cat['id'] ?>" tabindex="0">
        <?php foreach ($produtosPorCategoria[$cat['id']] as $prod): ?>
          <a href="detalheProduto.php?id=<?= $prod['id'] ?>" class="product-card" aria-label="Produto <?= htmlspecialchars($prod['nome']) ?>">
            <img src="<?= htmlspecialchars($prod['imagem']) ?>" alt="<?= htmlspecialchars($prod['nome']) ?>" loading="lazy" />
            <div class="product-name"><?= htmlspecialchars($prod['nome']) ?></div>
            <div class="product-price"><?= number_format($prod['preco'], 2, ',', '.') ?> MT</div>
          </a>
        <?php endforeach; ?>
      </div>
      <div class="carousel-btns">
        <button type="button" onclick="scrollCarousel('carousel-<?= $cat['id'] ?>', -300)">◀</button>
        <button type="button" onclick="scrollCarousel('carousel-<?= $cat['id'] ?>', 300)">▶</button>
      </div>
    </section>
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
