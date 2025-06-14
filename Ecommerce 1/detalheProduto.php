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

    // Buscar produto para validar e pegar nome/preço atualizados
    $stmt = $pdo->prepare("SELECT id, nome, preco FROM produtos WHERE id = ?");
    $stmt->execute([$produto_id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Verificar se o produto já está no carrinho e incrementar quantidade
        $existe = false;
        foreach ($_SESSION['carrinho'] as &$item) {
            if ($item['id'] == $produto['id']) {
                $item['quantidade'] += 1;
                $existe = true;
                break;
            }
        }
        unset($item);

        // Se não existe, adicionar novo
        if (!$existe) {
            $_SESSION['carrinho'][] = [
                'id' => $produto['id'],
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'quantidade' => 1,
            ];
        }

        // Redirecionar para evitar reenvio do formulário
        header('Location: carrinho.php');
        exit;
    } else {
        // Produto inválido
        die("Produto inválido.");
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?= htmlspecialchars($produto['nome']) ?> - Detalhes</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #f8f9fa;
    margin: 0; padding: 20px;
  }
  .detalhe-container {
    max-width: 1000px;
    margin: 40px auto;
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
  }
  .imagem-principal {
    flex: 1 1 400px;
  }
  .imagem-principal img {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  }
  .miniaturas {
    margin-top: 15px;
    display: flex;
    gap: 15px;
  }
  .miniaturas img {
    width: 100px;
    height: 80px;
    object-fit: cover;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }
  .detalhes-produto {
    flex: 1 1 400px;
  }
  .detalhes-produto h1 {
    margin-top: 0;
    font-size: 32px;
  }
  .categoria-produto {
    color: #555;
    font-size: 16px;
    margin-bottom: 10px;
  }
  .preco-produto {
    font-size: 28px;
    color: #008000;
    font-weight: bold;
    margin-bottom: 20px;
  }
  .descricao-produto {
    font-size: 16px;
    margin-bottom: 25px;
  }
  .estoque {
    font-weight: 600;
    margin-bottom: 25px;
  }
  .botoes-compra form {
    display: inline-block;
    margin-right: 15px;
  }
  button {
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: background-color 0.3s ease, border-color 0.3s ease;
  }
  .btn-outline-primary {
    background-color: transparent;
    border-color: #007bff;
    color: #007bff;
  }
  .btn-outline-primary:hover {
    background-color: #007bff;
    color: white;
  }
  .btn-success {
    background-color: #28a745;
    color: white;
    border-color: #28a745;
  }
  .btn-success:hover {
    background-color: #1e7e34;
    border-color: #1c7430;
  }
  @media(max-width: 800px) {
    .detalhe-container {
      flex-direction: column;
      gap: 30px;
    }
    .imagem-principal, .detalhes-produto {
      flex: 1 1 100%;
    }
    .miniaturas {
      justify-content: center;
    }
  }
</style>
</head>
<body>

<div class="detalhe-container">

  <!-- Imagem principal -->
  <div class="imagem-principal">
    <img src="uploads/<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" />
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
      <form method="POST" action="carrinho.php">
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
