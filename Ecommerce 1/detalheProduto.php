<?php
session_start();
include('includes/header.php'); // se quiser manter o header incluído aqui

require 'db.php'; // sua conexão PDO

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("Produto inválido.");
}

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

// Processar adicionar produto via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto_id'])) {
    $produto_id = (int) $_POST['produto_id'];

    $stmt = $pdo->prepare("SELECT id, nome, preco FROM produtos WHERE id = ?");
    $stmt->execute([$produto_id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        $existe = false;
        foreach ($_SESSION['carrinho'] as &$item) {
            if ($item['id'] == $produto['id']) {
                $item['quantidade'] += 1;
                $existe = true;
                break;
            }
        }
        unset($item);

        if (!$existe) {
            $_SESSION['carrinho'][] = [
                'id' => $produto['id'],
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'quantidade' => 1,
            ];
        }

        header('Location: carrinho.php');
        exit;
    } else {
        die("Produto inválido.");
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="detalheproduto.css">
<title><?= htmlspecialchars($produto['nome']) ?> - Detalhes</title>

<script>
  // Miniaturas trocando a imagem principal
  document.addEventListener('DOMContentLoaded', () => {
    const mainImg = document.querySelector('.imagem-principal img');
    const miniImgs = document.querySelectorAll('.miniaturas img');
    miniImgs.forEach(mini => {
      mini.addEventListener('click', () => {
        mainImg.src = mini.src;
      });
    });
  });
</script>
</head>
<body>

<div class="detalhe-container">

  <!-- Imagem principal -->
  <div class="imagem-principal">
    <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" />
 
    <div class="miniaturas">
      <img src="uploads/<?= htmlspecialchars($produto['imagem']) ?>" alt="Miniatura 1" />
      <img src="uploads/<?= htmlspecialchars($produto['imagem']) ?>" alt="Miniatura 2" />
      <img src="uploads/<?= htmlspecialchars($produto['imagem']) ?>" alt="Miniatura 3" />
    </div>
  </div>

  <!-- Detalhes -->
  <div class="detalhes-produto">
    <h1><?= htmlspecialchars($produto['nome']) ?></h1>
    <div class="categoria-produto"><?= htmlspecialchars($produto['categoria'] ?? 'Categoria não definida') ?></div>
    <div class="preco-produto"><?= number_format($produto['preco'], 2, ',', '.') ?> MT</div>
    <div class="descricao-produto"><?= nl2br(htmlspecialchars($produto['descricao'])) ?></div>
    <div class="estoque">Estoque disponível: <?= isset($produto['estoque']) ? (int)$produto['estoque'] : 0 ?> unidades</div>

    <div class="botoes-compra">
      <form method="POST" action="detalheproduto.php?id=<?= $produto['id'] ?>">

        <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
        <button type="submit" class="btn-outline-primary">Adicionar ao Carrinho</button>
      </form>

      <form method="POST" action="checkout.php">
        <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
        <input type="hidden" name="preco" value="<?= $produto['preco'] ?>">
        <input type="hidden" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>">
        <button type="submit" class="btn-success">Comprar Agora</button>
      </form>
    </div>
  </div>

</div>

<?php include('includes/footer.php'); ?>
</body>
</html>
