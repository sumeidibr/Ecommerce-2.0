<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Relatórios - Painel Admin</title>
  <link rel="stylesheet" href="css/admin.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f2f5;
    }

    .main-content {
      margin-left: 250px;
      padding: 30px;
    }

    h1 {
      margin-bottom: 30px;
      color: #333;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 1px 10px rgba(0,0,0,0.1);
    }

    .card h3 {
      margin-bottom: 10px;
      font-size: 18px;
      color: #555;
    }

    canvas {
      width: 100% !important;
      height: 300px !important;
    }
  </style>
</head>
<body>

<div class="main-content">
  <h1>Relatórios</h1>

  <div class="card-grid">
    <div class="card">
      <h3>Vendas por Mês</h3>
      <canvas id="vendasMes"></canvas>
    </div>

    <div class="card">
      <h3>Produtos Mais Vendidos</h3>
      <canvas id="produtosMaisVendidos"></canvas>
    </div>

    <div class="card">
      <h3>Clientes Mais Ativos</h3>
      <canvas id="clientesAtivos"></canvas>
    </div>

    <div class="card">
      <h3>Faturamento por Canal</h3>
      <canvas id="faturamentoPorCanal"></canvas>
    </div>
  </div>
</div>

<script>
  // Exemplo de dados (substitua com dados reais do PHP via JSON)
  const vendasPorMes = {
    labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun"],
    datasets: [{
      label: "Vendas (MT)",
      data: [12000, 15000, 18000, 10000, 25000, 21000],
      backgroundColor: "#007bff"
    }]
  };

  const produtosMaisVendidos = {
    labels: ["T-shirt", "Tênis", "Relógio", "Chapéu", "Bolsa"],
    datasets: [{
      label: "Quantidade",
      data: [80, 65, 45, 30, 25],
      backgroundColor: [
        "#36a2eb", "#ff6384", "#ffcd56", "#4bc0c0", "#9966ff"
      ]
    }]
  };

  const clientesMaisAtivos = {
    labels: ["João", "Maria", "Carlos", "Ana", "Bruno"],
    datasets: [{
      label: "Compras",
      data: [12, 10, 9, 7, 5],
      backgroundColor: "#28a745"
    }]
  };

  const faturamentoPorCanal = {
    labels: ["M-Pesa", "Cartão", "PayPal", "Em Dinheiro"],
    datasets: [{
      label: "Faturamento (MT)",
      data: [20000, 15000, 10000, 8000],
      backgroundColor: [
        "#ffc107", "#17a2b8", "#6f42c1", "#dc3545"
      ]
    }]
  };

  // Criação dos gráficos
  new Chart(document.getElementById('vendasMes'), {
    type: 'bar',
    data: vendasPorMes
  });

  new Chart(document.getElementById('produtosMaisVendidos'), {
    type: 'doughnut',
    data: produtosMaisVendidos
  });

  new Chart(document.getElementById('clientesAtivos'), {
    type: 'bar',
    data: clientesMaisAtivos
  });

  new Chart(document.getElementById('faturamentoPorCanal'), {
    type: 'pie',
    data: faturamentoPorCanal
  });
</script>

</body>
</html>
