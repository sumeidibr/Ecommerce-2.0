<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detalhes do Pedido</title>
  <link rel="stylesheet" href="css/admin.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

    body {
      margin: 0;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
        Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      background-color: #f9fafb;
      color: #333;
    }

    .main-content {
      margin-left: 250px;
      padding: 40px 60px;
      max-width: 1000px;
      margin-right: auto;
      margin-top: 40px;
    }

    h1 {
      font-weight: 700;
      font-size: 2.4rem;
      color: #1f2937;
      margin-bottom: 30px;
      letter-spacing: 0.02em;
    }

    .section {
      background: #ffffff;
      border-radius: 12px;
      padding: 30px 35px;
      margin-bottom: 40px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.05);
      transition: box-shadow 0.3s ease;
    }

    .section:hover {
      box-shadow: 0 12px 40px rgba(0,0,0,0.08);
    }

    .section h2 {
      font-size: 1.8rem;
      font-weight: 600;
      color: #111827;
      margin-bottom: 20px;
      border-left: 4px solid #2563eb;
      padding-left: 12px;
    }

    .info-line {
      font-size: 1.1rem;
      margin-bottom: 12px;
      color: #4b5563;
    }
    .info-line strong {
      color: #111827;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 12px;
      font-size: 1rem;
      color: #374151;
    }

    thead tr {
      background-color: #2563eb;
      color: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    thead th {
      padding: 16px 20px;
      text-align: left;
      font-weight: 600;
      font-size: 1.1rem;
      user-select: none;
      border: none;
    }

    tbody tr {
      background-color: #f3f4f6;
      border-radius: 10px;
      transition: background-color 0.2s ease;
      cursor: default;
    }
    tbody tr:hover {
      background-color: #e0e7ff;
    }

    tbody td {
      padding: 15px 20px;
      border: none;
      vertical-align: middle;
      font-weight: 500;
    }

    .status-select {
      padding: 12px 15px;
      border-radius: 8px;
      border: 1.8px solid #cbd5e1;
      font-size: 1rem;
      width: 220px;
      font-weight: 600;
      color: #1f2937;
      transition: border-color 0.3s ease;
      outline-offset: 2px;
    }
    .status-select:focus {
      border-color: #2563eb;
      box-shadow: 0 0 5px rgba(37, 99, 235, 0.5);
      outline: none;
    }

    .btn-atualizar {
      margin-top: 20px;
      padding: 14px 28px;
      background: linear-gradient(90deg, #2563eb 0%, #3b82f6 100%);
      border: none;
      border-radius: 10px;
      color: white;
      font-weight: 700;
      font-size: 1.1rem;
      cursor: pointer;
      box-shadow: 0 6px 16px rgba(59, 130, 246, 0.5);
      transition: background 0.3s ease, box-shadow 0.3s ease;
      user-select: none;
    }
    .btn-atualizar:hover {
      background: linear-gradient(90deg, #1e40af 0%, #2563eb 100%);
      box-shadow: 0 8px 24px rgba(30, 64, 175, 0.7);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 20px 15px;
      }

      table thead tr {
        display: none;
      }

      table, tbody, tr, td {
        display: block;
        width: 100%;
      }

      tbody tr {
        margin-bottom: 20px;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 12px;
        padding: 20px;
      }

      tbody td {
        padding: 10px 10px;
        text-align: right;
        font-size: 1rem;
        border: none;
        position: relative;
      }

      tbody td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: 600;
        color: #2563eb;
        text-transform: uppercase;
        font-size: 0.85rem;
      }

      .status-select {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="main-content">
  <h1>Pedido #1023 - Detalhes</h1>

  <section class="section">
    <h2>Informações do Cliente</h2>
    <div class="info-line"><strong>Nome:</strong> João Carlos</div>
    <div class="info-line"><strong>Email:</strong> joao@gmail.com</div>
    <div class="info-line"><strong>Telefone:</strong> +258 84 123 4567</div>
    <div class="info-line"><strong>Endereço:</strong> Av. 25 de Setembro, Maputo</div>
  </section>

  <section class="section">
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
          <td data-label="Produto">Ténis Nike Air</td>
          <td data-label="Qtd">1</td>
          <td data-label="Preço Unitário">2.000,00 MT</td>
          <td data-label="Subtotal">2.000,00 MT</td>
        </tr>
        <tr>
          <td data-label="Produto">Meias Esportivas</td>
          <td data-label="Qtd">2</td>
          <td data-label="Preço Unitário">225,00 MT</td>
          <td data-label="Subtotal">450,00 MT</td>
        </tr>
      </tbody>
    </table>
  </section>

  <section class="section">
    <h2>Resumo do Pedido</h2>
    <div class="info-line"><strong>Subtotal:</strong> 2.450,00 MT</div>
    <div class="info-line"><strong>Frete:</strong> 100,00 MT</div>
    <div class="info-line" style="font-size: 1.3rem; font-weight: 700; color: #111827;">
      <strong>Total:</strong> 2.550,00 MT
    </div>
  </section>

  <section class="section">
    <h2>Status do Pedido</h2>
    <form method="POST">
      <select class="status-select" name="status">
        <option value="pendente">Pendente</option>
        <option value="pago">Pago</option>
        <option value="enviado">Enviado</option>
        <option value="cancelado">Cancelado</option>
      </select>
      <button class="btn-atualizar" type="submit">Atualizar Status</button>
    </form>
  </section>
</div>

</body>
</html>
