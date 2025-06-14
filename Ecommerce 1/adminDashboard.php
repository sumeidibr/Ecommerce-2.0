<?php
session_start();

// Dados simulados
$produtos_total = 125;
$usuarios_total = 87;
$pedidos_total = 63;

$dados_vendas = [1200, 1500, 1800, 1100, 2400, 3000, 2800];
$meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul'];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - E-commerce</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0; padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      display: flex;
      min-height: 100vh;
      background-color: #f4f6f8;
      color: #333;
    }

    .main {
      margin-left: 240px;
      padding: 30px;
      flex: 1;
    }

    .cards {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      margin-bottom: 30px;
    }
    .card {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
      flex: 1;
      min-width: 250px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .card h3 {
      margin-bottom: 10px;
      color: #555;
    }
    .card span {
      font-size: 28px;
      font-weight: bold;
    }

    .graficos {
      display: grid;
      grid-template-columns: 1fr;
      gap: 30px;
    }

    canvas {
      background-color: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    @media (max-width: 768px) {
      .main {
        margin-left: 0;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <?php include('sidebar.php'); ?>

  <div class="main">
    <h1>Painel de Controle</h1>

    <div class="cards">
      <div class="card">
        <h3>Total de Produtos</h3>
        <span><?= $produtos_total ?></span>
      </div>
      <div class="card">
        <h3>Total de Usuários</h3>
        <span><?= $usuarios_total ?></span>
      </div>
      <div class="card">
        <h3>Total de Pedidos</h3>
        <span><?= $pedidos_total ?></span>
      </div>
    </div>

    <div class="graficos">
      <canvas id="graficoVendas" height="100"></canvas>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('graficoVendas').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?= json_encode($meses) ?>,
        datasets: [{
          label: 'Vendas (MT)',
          data: <?= json_encode($dados_vendas) ?>,
          borderColor: '#2563eb',
          backgroundColor: 'rgba(37, 99, 235, 0.2)',
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
      }
    });
  </script>
</body>
</html>
