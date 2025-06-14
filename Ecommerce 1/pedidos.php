<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Painel Administrativo - Pedidos</title>
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

    .filtros-status {
      margin-bottom: 25px;
    }

    .filtros-status button {
      padding: 10px 18px;
      border: none;
      margin-right: 10px;
      border-radius: 5px;
      cursor: pointer;
      background-color: #e0e0e0;
      transition: all 0.2s ease;
    }

    .filtros-status button:hover {
      background-color: #007bff;
      color: white;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    thead {
      background-color: #007bff;
      color: white;
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .status {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: bold;
    }

    .pendente { background-color: #ffecb3; color: #8d6e63; }
    .pago     { background-color: #c8e6c9; color: #2e7d32; }
    .enviado  { background-color: #bbdefb; color: #1565c0; }
    .cancelado{ background-color: #ffcdd2; color: #c62828; }

    .btn-detalhes {
      padding: 6px 12px;
      background-color: #343a40;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
    }

    .btn-detalhes:hover {
      background-color: #212529;
    }
  </style>
</head>
<body>

<div class="main-content">
  <h1>Pedidos</h1>

  <div class="filtros-status">
    <button>Todos</button>
    <button>Pendente</button>
    <button>Pago</button>
    <button>Enviado</button>
    <button>Cancelado</button>
  </div>

  <table>
    <thead>
      <tr>
        <th>#ID</th>
        <th>Cliente</th>
        <th>Total</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>#1023</td>
        <td>João Carlos</td>
        <td>2.450,00 MT</td>
        <td><span class="status pendente">Pendente</span></td>
        <td>13/06/2025</td>
        <td><a href="pedido_detalhes.php?id=1023" class="btn-detalhes">Detalhes</a></td>
      </tr>
      <tr>
        <td>#1022</td>
        <td>Maria Luís</td>
        <td>7.850,00 MT</td>
        <td><span class="status pago">Pago</span></td>
        <td>12/06/2025</td>
        <td><a href="pedido_detalhes.php?id=1022" class="btn-detalhes">Detalhes</a></td>
      </tr>
      <tr>
        <td>#1021</td>
        <td>Filipe Júnior</td>
        <td>1.900,00 MT</td>
        <td><span class="status enviado">Enviado</span></td>
        <td>12/06/2025</td>
        <td><a href="pedido_detalhes.php?id=1021" class="btn-detalhes">Detalhes</a></td>
      </tr>
      <tr>
        <td>#1020</td>
        <td>Celina Pedro</td>
        <td>980,00 MT</td>
        <td><span class="status cancelado">Cancelado</span></td>
        <td>11/06/2025</td>
        <td><a href="pedido_detalhes.php?id=1020" class="btn-detalhes">Detalhes</a></td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
