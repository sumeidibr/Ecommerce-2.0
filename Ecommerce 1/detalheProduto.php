<?php include('includes/header.php'); ?>

<?php
// Simulação de produto (normalmente viria do banco de dados)
$produto = [
  'id' => $_GET['id'] ?? 1,
  'nome' => 'Samsung Galaxy A23',
  'descricao' => 'O Samsung Galaxy A23 possui uma excelente performance, câmera de alta resolução, e bateria de longa duração.',
  'preco' => 12500,
  'estoque' => 10,
  'categoria' => 'Celulares',
  'imagem' => 'assets/img/celular.jpg'
];
?>

<div class="container mt-5">
  <div class="row">
    
    <!-- Imagem do Produto -->
    <div class="col-md-6">
      <img src="<?= $produto['imagem'] ?>" class="img-fluid rounded shadow" alt="<?= $produto['nome'] ?>">
    </div>

    <!-- Informações do Produto -->
    <div class="col-md-6">
      <h2><?= $produto['nome'] ?></h2>
      <p class="text-muted"><?= $produto['categoria'] ?></p>
      <h4 class="text-success"><?= number_format($produto['preco'], 2) ?> MT</h4>

      <p class="mt-3"><?= $produto['descricao'] ?></p>
      
      <p><strong>Estoque disponível:</strong> <?= $produto['estoque'] ?> unidades</p>

      <div class="mt-4 d-flex gap-2">
        <form method="POST" action="carrinho.php">
          <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
          <button type="submit" class="btn btn-outline-primary">Adicionar ao Carrinho</button>
        </form>

        <form method="POST" action="checkout.php">
          <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
          <input type="hidden" name="preco" value="<?= $produto['preco'] ?>">
          <input type="hidden" name="nome" value="<?= $produto['nome'] ?>">
          <button type="submit" class="btn btn-success">Comprar Agora</button>
        </form>
      </div>
    </div>

  </div>
</div>

<?php include('includes/footer.php'); ?>
