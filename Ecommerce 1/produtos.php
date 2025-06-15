<?php
session_start();
include('includes/header.php');
require 'db.php';

// Puxar categorias
$stmtCat = $pdo->query("SELECT * FROM categorias");
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// Puxar todos os produtos
$stmtProdutos = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
$produtos = $stmtProdutos->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <title>Produtos - Gordanda Services</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .filter-card {
      background: #f8f9fa;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
      position: sticky;
      top: 90px;
    }

    h4 {
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 1.5rem;
    }

    .card {
      border-radius: 12px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 24px rgb(0 0 0 / 0.15);
    }

    .card-img-top {
      height: 200px;
      object-fit: cover;
      border-bottom: 1px solid #eee;
    }

    .card-title {
      font-weight: 700;
      font-size: 1.2rem;
      color: #34495e;
    }

    .card-text {
      font-weight: 600;
      color: #27ae60;
      margin-bottom: 1rem;
      font-size: 1.1rem;
    }

    .btn-outline-primary {
      font-weight: 600;
      border-radius: 8px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    .btn-outline-primary:hover {
      background-color: #2980b9;
      color: #fff;
      border-color: #2980b9;
    }

    .form-label {
      font-weight: 600;
      color: #34495e;
    }

    .products-list {
      max-height: 75vh;
      overflow-y: auto;
    }

    .products-list::-webkit-scrollbar {
      width: 8px;
    }
    .products-list::-webkit-scrollbar-thumb {
      background: #2980b9;
      border-radius: 20px;
    }
    .products-list::-webkit-scrollbar-track {
      background: #ecf0f1;
      border-radius: 20px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="row">

    <!-- Filtros -->
    <aside class="col-md-3">
      <div class="filter-card">
        <h4>Filtrar Produtos</h4>
        <form method="GET" action="">
          <div class="mb-4">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-select" id="categoria" name="categoria">
              <option value="">Todas</option>
              <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nome']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-4">
            <label for="preco_min" class="form-label">Preço mínimo (MT)</label>
            <input type="number" class="form-control" id="preco_min" name="preco_min" placeholder="0" min="0" />
          </div>

          <div class="mb-4">
            <label for="preco_max" class="form-label">Preço máximo (MT)</label>
            <input type="number" class="form-control" id="preco_max" name="preco_max" placeholder="100000" min="0" />
          </div>

          <div class="mb-4">
            <label for="pesquisa" class="form-label">Nome do Produto</label>
            <input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Ex: Samsung" />
          </div>

          <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Pesquisar</button>
        </form>
      </div>
    </aside>

    <!-- Catálogo de Produtos -->
    <section class="col-md-9">
      <h4>Produtos Encontrados</h4>
      <div class="row products-list">

        <?php foreach ($produtos as $prod): ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <img src="<?= htmlspecialchars($prod['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($prod['nome']) ?>" />
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?= htmlspecialchars($prod['nome']) ?></h5>
                <p class="card-text">Preço: <?= number_format($prod['preco'], 2, ',', '.') ?> MT</p>
                <a href="detalheProduto.php?id=<?= $prod['id'] ?>" class="btn btn-outline-primary mt-auto">Ver Detalhes</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </section>

  </div>
</div>

<?php include('includes/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
