<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detalhes do Pedido</title>
  <link rel="stylesheet" href="css/admin.css" />
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
    }

    .main-content {
      margin-left: 250px;
      padding: 30px;
    }

    h1 {
      margin-bottom: 20px;
      color: #333;
    }

    .section {
      background-color: white;
      padding: 20px;
      margin-bottom: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .section h2 {
      font-size: 20px;
      margin-bottom: 15px;
      color: #444;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }

    .status-select {
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .btn-atualizar {
      margin-top: 10px;
      padding: 10px 15px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-atualizar:hover {
      background-color: #0056b3;
    }

    .info-line {
      margin: 6px 0;
    }
  </style>
</head>
<body>

<div class="main-content">
  <h1>Pedido #1023 - Detalhes</h1>

  <div class="section">
    <h2>Informações do Cliente</h2>
    <div class="info-line"><strong>Nome:</strong> João Carlos</div>
    <div class="info-line"><strong>Email:</strong> joao@gmail.com</div>
    <div class="info-line"><strong>Telefone:</strong> +258 84 123 4567</div>
    <div class="info-line"><strong>Endereço:</strong> Av. 25 de Setembro, Maputo</div>
  </div>

  <div class="section">
    <h2>Produtos do Pedido</h2>
    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Qtd</th>
          <th>Preço Unitário</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Ténis Nike Air</td>
          <td>1</td>
          <td>2.000,00 MT</td>
          <td>2.000,00 MT</td>
        </tr>
        <tr>
          <td>Meias Esportivas</td>
          <td>2</td>
          <td>225,00 MT</td>
          <td>450,00 MT</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="section">
    <h2>Resumo do Pedido</h2>
    <div class="info-line"><strong>Subtotal:</strong> 2.450,00 MT</div>
    <div class="info-line"><strong>Frete:</strong> 100,00 MT</div>
    <div class="info-line"><strong>Total:</strong> <strong>2.550,00 MT</strong></div>
  </div>

  <div class="section">
    <h2>Status do Pedido</h2>
    <form method="POST">
      <select class="status-select" name="status">
        <option value="pendente">Pendente</option>
        <option value="pago">Pago</option>
        <option value="enviado">Enviado</option>
        <option value="cancelado">Cancelado</option>
      </select>
      <br />
      <button class="btn-atualizar" type="submit">Atualizar Status</button>
    </form>
  </div>

</div>

</body>
</html>
