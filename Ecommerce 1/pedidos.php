<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Painel Administrativo - Pedidos</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

    /* Reset básico */
    *, *::before, *::after {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: #f9fafb;
      color: #1f2937;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    .main-content {
      margin-left: 250px;
      padding: 40px 50px;
      min-height: 100vh;
      background: #f9fafb;
      transition: margin-left 0.3s ease;
    }

    h1 {
      font-weight: 700;
      font-size: 2.4rem;
      margin-bottom: 30px;
      color: #111827;
      letter-spacing: -0.02em;
      user-select: none;
    }

    /* Filtros de status */
    .filtros-status {
      margin-bottom: 35px;
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }

    .filtros-status button {
      background-color: #e0e7ff;
      border: none;
      padding: 12px 25px;
      border-radius: 30px;
      font-weight: 600;
      font-size: 0.9rem;
      color: #4338ca;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(67,56,202,0.15);
      transition: all 0.25s cubic-bezier(.4,0,.2,1);
      user-select: none;
    }

    .filtros-status button:hover,
    .filtros-status button.active {
      background-color: #4338ca;
      color: #f9fafb;
      box-shadow: 0 8px 20px rgba(67,56,202,0.35);
      transform: translateY(-2px);
    }

    /* Tabela com design moderno */
    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 12px;
      font-size: 1rem;
      color: #374151;
      overflow: hidden;
      user-select: none;
    }

    thead tr {
      background: transparent;
    }

    thead th {
      text-align: left;
      padding: 12px 20px;
      font-weight: 600;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      font-size: 0.85rem;
      user-select: none;
    }

    tbody tr {
      background: #fff;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      border-radius: 12px;
      transition: box-shadow 0.25s ease;
      cursor: pointer;
      user-select: none;
    }

    tbody tr:hover {
      box-shadow: 0 8px 20px rgba(67,56,202,0.15);
      background: #f0f4ff;
    }

    tbody td {
      padding: 18px 20px;
      vertical-align: middle;
    }

    /* Status badges */
    .status {
      display: inline-block;
      padding: 7px 18px;
      border-radius: 9999px;
      font-size: 0.85rem;
      font-weight: 600;
      text-align: center;
      user-select: none;
      box-shadow: 0 1px 5px rgba(0,0,0,0.08);
      transition: background-color 0.3s ease, color 0.3s ease;
      min-width: 95px;
    }
    .pendente {
      background-color: #fef3c7;
      color: #92400e;
      box-shadow: 0 1px 8px #fbbf24aa;
    }
    .pago {
      background-color: #dcfce7;
      color: #166534;
      box-shadow: 0 1px 8px #22c55eaa;
    }
    .enviado {
      background-color: #dbeafe;
      color: #1e40af;
      box-shadow: 0 1px 8px #3b82f6aa;
    }
    .cancelado {
      background-color: #fee2e2;
      color: #991b1b;
      box-shadow: 0 1px 8px #ef4444aa;
    }

    /* Botão detalhes */
    .btn-detalhes {
      background: linear-gradient(135deg, #6366f1, #4338ca);
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 0.9rem;
      text-decoration: none;
      box-shadow: 0 4px 14px rgba(67,56,202,0.5);
      transition: background 0.3s ease, transform 0.2s ease;
      user-select: none;
      display: inline-block;
    }
    .btn-detalhes:hover {
      background: linear-gradient(135deg, #4338ca, #6366f1);
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(67,56,202,0.6);
    }

    /* Responsividade */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 30px 20px;
      }
      table {
        font-size: 0.9rem;
      }
      thead th {
        display: none;
      }
      tbody td {
        display: block;
        width: 100%;
        padding: 15px 15px;
        text-align: right;
        position: relative;
        border-bottom: 1px solid #eee;
      }
      tbody td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        top: 15px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #6b7280;
        text-align: left;
      }
      tbody tr {
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border-radius: 12px;
        display: block;
      }
      .btn-detalhes {
        width: 100%;
        text-align: center;
        padding: 12px 0;
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

<div class="main-content">
  <h1>Pedidos</h1>

  <div class="filtros-status">
    <button class="active">Todos</button>
    <button>Pendente</button>
    <button>Pago</button>
    <button>Enviado</button>
    <button>Cancelado</button>
  </div>

  <table role="grid" aria-label="Tabela de Pedidos">
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
      <tr tabindex="0">
        <td data-label="#ID">#1023</td>
        <td data-label="Cliente">João Carlos</td>
        <td data-label="Total">2.450,00 MT</td>
        <td data-label="Status"><span class="status pendente">Pendente</span></td>
        <td data-label="Data">13/06/2025</td>
        <td data-label="Ações">
          <a href="pedido_detalhe.php" class="btn-detalhes" aria-label="Ver detalhes do pedido 1023">Detalhes</a>
        </td>
      </tr>
      <tr tabindex="0">
        <td data-label="#ID">#1022</td>
        <td data-label="Cliente">Maria Luís</td>
        <td data-label="Total">7.850,00 MT</td>
        <td data-label="Status"><span class="status pago">Pago</span></td>
        <td data-label="Data">12/06/2025</td>
        <td data-label="Ações">
          <a href="pedido_detalhe.php" class="btn-detalhes" aria-label="Ver detalhes do pedido 1022">Detalhes</a>
        </td>
      </tr>
      <tr tabindex="0">
        <td data-label="#ID">#1021</td>
        <td data-label="Cliente">Filipe Júnior</td>
        <td data-label="Total">1.900,00 MT</td>
        <td data-label="Status"><span class="status enviado">Enviado</span></td>
        <td data-label="Data">12/06/2025</td>
        <td data-label="Ações">
          <a href="pedido_detalhe.php" class="btn-detalhes" aria-label="Ver detalhes do pedido 1021">Detalhes</a>
        </td>
      </tr>
      <tr tabindex="0">
        <td data-label="#ID">#1020</td>
        <td data-label="Cliente">Celina Pedro</td>
        <td data-label="Total">980,00 MT</td>
        <td data-label="Status"><span class="status cancelado">Cancelado</span></td>
        <td data-label="Data">11/06/2025</td>
        <td data-label="Ações">
          <a href="pedido_detalhes.php" class="btn-detalhes" aria-label="Ver detalhes do pedido 1020">Detalhes</a>
        </td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
