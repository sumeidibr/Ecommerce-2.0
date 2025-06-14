<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Produtos - Admin</title>
  <link rel="stylesheet" href="css/admin.css" />
  <style>
    .main-content {
      margin-left: 250px;
      padding: 30px;
      font-family: 'Segoe UI', sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 1px 5px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #007bff;
      color: white;
    }

    .actions button {
      margin-right: 5px;
    }

    .form-container {
      margin-top: 30px;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 1px 10px rgba(0,0,0,0.1);
    }

    input, select {
      display: block;
      width: 100%;
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"] {
      background: #007bff;
      color: white;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="main-content">
  <h1>Gerenciamento de Produtos</h1>

  <table>
    <thead>
      <tr>
        <th>Imagem</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Categoria</th>
        <th>Marca</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <!-- Substitua com loop PHP -->
      <tr>
        <td><img src="img/exemplo.jpg" width="50" /></td>
        <td>Camiseta Azul</td>
        <td>850 MT</td>
        <td>15</td>
        <td>Roupas</td>
        <td>Marca X</td>
        <td class="actions">
          <button>Editar</button>
          <button>Remover</button>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="form-container">
    <h2>Criar / Editar Produto</h2>
    <form method="POST" enctype="multipart/form-data">
      <input type="text" name="nome" placeholder="Nome do Produto" required />
      <input type="number" name="preco" placeholder="Preço (MT)" required />
      <input type="number" name="estoque" placeholder="Quantidade em Estoque" required />

      <select name="categoria">
        <option value="">Selecione uma categoria</option>
        <option value="roupas">Roupas</option>
        <option value="tecnologia">Tecnologia</option>
      </select>

      <select name="marca">
        <option value="">Selecione uma marca</option>
        <option value="marca_x">Marca X</option>
        <option value="marca_y">Marca Y</option>
      </select>

      <label>Variações:</label>
      <input type="text" name="tamanho" placeholder="Tamanho (ex: M, G)" />
      <input type="text" name="cor" placeholder="Cor (ex: Azul, Preto)" />

      <label>Imagem do Produto:</label>
      <input type="file" name="imagem" accept="image/*" />

      <input type="submit" value="Salvar Produto" />
    </form>
  </div>
</div>

</body>
</html>
