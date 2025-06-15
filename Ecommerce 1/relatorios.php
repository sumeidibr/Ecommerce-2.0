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
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
      color: #333;
    }

    .main-content {
      margin-left: 250px;
      padding: 30px 40px;
      max-width: 1200px;
      margin-right: auto;
      margin-bottom: 50px;
    }

    h1 {
      margin-bottom: 25px;
      font-weight: 700;
      font-size: 2rem;
      color: #222;
    }

    .filter-container {
      display: flex;
      gap: 15px;
      margin-bottom: 30px;
      align-items: center;
      flex-wrap: wrap;
    }

    .filter-container label {
      font-weight: 600;
      font-size: 0.9rem;
      color: #555;
    }

    input[type="date"] {
      padding: 8px 12px;
      border-radius: 6px;
      border: 1.8px solid #ccc;
      font-size: 1rem;
      transition: border-color 0.3s ease;
      cursor: pointer;
    }

    input[type="date"]:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }

    button#filterBtn {
      background-color: #007bff;
      border: none;
      color: white;
      font-weight: 600;
      padding: 10px 18px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    button#filterBtn:hover {
      background-color: #0056b3;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 25px;
    }

    .card {
      background-color: white;
      padding: 25px 20px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: box-shadow 0.3s ease;
    }

    .card:hover {
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
    }

    .card h3 {
      margin-bottom: 18px;
      font-size: 1.3rem;
      font-weight: 700;
      color: #444;
    }

    canvas {
      width: 100% !important;
      height: 320px !important;
      user-select: none;
    }

    /* Responsive tweaks */
    @media (max-width: 600px) {
      .filter-container {
        flex-direction: column;
        align-items: flex-start;
      }

      button#filterBtn {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="main-content">
  <h1>Relatórios</h1>

  <form id="filterForm" class="filter-container" onsubmit="return false;">
    <label for="startDate">Data Início:</label>
    <input type="date" id="startDate" name="startDate" />

    <label for="endDate">Data Fim:</label>
    <input type="date" id="endDate" name="endDate" />

    <button id="filterBtn" type="submit">Filtrar</button>
  </form>

  <div class="card-grid">
    <div class="card">
      <h3>Vendas por Mês (Barra)</h3>
      <canvas id="vendasMes"></canvas>
    </div>

    <div class="card">
      <h3>Vendas Acumuladas (Linha)</h3>
      <canvas id="vendasAcumuladas"></canvas>
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
      <h3>Faturamento por Canal (Pizza)</h3>
      <canvas id="faturamentoPorCanal"></canvas>
    </div>

    <div class="card">
      <h3>Faturamento Mensal (Linha)</h3>
      <canvas id="faturamentoMensal"></canvas>
    </div>
  </div>
</div>

<script>
  // Dados iniciais exemplo
  const labelsMeses = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun"];

  const vendasPorMesData = [12000, 15000, 18000, 10000, 25000, 21000];

  // Calcula vendas acumuladas para gráfico de linha
  function calcVendasAcumuladas(arr) {
    let acumulado = 0;
    return arr.map(value => acumulado += value);
  }

  const vendasAcumuladasData = calcVendasAcumuladas(vendasPorMesData);

  const produtosMaisVendidosData = [80, 65, 45, 30, 25];
  const produtosLabels = ["T-shirt", "Tênis", "Relógio", "Chapéu", "Bolsa"];

  const clientesMaisAtivosData = [12, 10, 9, 7, 5];
  const clientesLabels = ["João", "Maria", "Carlos", "Ana", "Bruno"];

  const faturamentoPorCanalData = [20000, 15000, 10000, 8000];
  const canaisLabels = ["M-Pesa", "Cartão", "PayPal", "Em Dinheiro"];

  const faturamentoMensalData = [10000, 13000, 16000, 9000, 21000, 19000];

  // Configuração e criação dos gráficos
  const ctxVendasMes = document.getElementById('vendasMes').getContext('2d');
  const chartVendasMes = new Chart(ctxVendasMes, {
    type: 'bar',
    data: {
      labels: labelsMeses,
      datasets: [{
        label: "Vendas (MT)",
        data: vendasPorMesData,
        backgroundColor: "#007bff"
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  });

  const ctxVendasAcumuladas = document.getElementById('vendasAcumuladas').getContext('2d');
  const chartVendasAcumuladas = new Chart(ctxVendasAcumuladas, {
    type: 'line',
    data: {
      labels: labelsMeses,
      datasets: [{
        label: "Vendas Acumuladas (MT)",
        data: vendasAcumuladasData,
        fill: true,
        backgroundColor: "rgba(0,123,255,0.2)",
        borderColor: "#007bff",
        tension: 0.3,
        pointRadius: 4,
        pointHoverRadius: 6,
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'top' } },
      scales: { y: { beginAtZero: true } }
    }
  });

  const ctxProdutosMaisVendidos = document.getElementById('produtosMaisVendidos').getContext('2d');
  const chartProdutosMaisVendidos = new Chart(ctxProdutosMaisVendidos, {
    type: 'doughnut',
    data: {
      labels: produtosLabels,
      datasets: [{
        label: "Quantidade",
        data: produtosMaisVendidosData,
        backgroundColor: [
          "#36a2eb", "#ff6384", "#ffcd56", "#4bc0c0", "#9966ff"
        ]
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } }
    }
  });

  const ctxClientesAtivos = document.getElementById('clientesAtivos').getContext('2d');
  const chartClientesAtivos = new Chart(ctxClientesAtivos, {
    type: 'bar',
    data: {
      labels: clientesLabels,
      datasets: [{
        label: "Compras",
        data: clientesMaisAtivosData,
        backgroundColor: "#28a745"
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  });

  const ctxFaturamentoPorCanal = document.getElementById('faturamentoPorCanal').getContext('2d');
  const chartFaturamentoPorCanal = new Chart(ctxFaturamentoPorCanal, {
    type: 'pie',
    data: {
      labels: canaisLabels,
      datasets: [{
        label: "Faturamento (MT)",
        data: faturamentoPorCanalData,
        backgroundColor: [
          "#ffc107", "#17a2b8", "#6f42c1", "#dc3545"
        ]
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'right' } }
    }
  });

  const ctxFaturamentoMensal = document.getElementById('faturamentoMensal').getContext('2d');
  const chartFaturamentoMensal = new Chart(ctxFaturamentoMensal, {
    type: 'line',
    data: {
      labels: labelsMeses,
      datasets: [{
        label: "Faturamento Mensal (MT)",
        data: faturamentoMensalData,
        fill: false,
        borderColor: "#28a745",
        tension: 0.3,
        pointRadius: 4,
        pointHoverRadius: 6,
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'top' } },
      scales: { y: { beginAtZero: true } }
    }
  });

  // Função simulada para atualizar os gráficos ao filtrar
  function filtrarRelatorios(startDate, endDate) {
    console.log('Filtrando de', startDate, 'até', endDate);

    // Simula dados novos aleatórios para efeito visual
    function randomDataArray(length, max) {
      return Array.from({ length }, () => Math.floor(Math.random() * max));
    }

    // Atualiza dados e recalcula acumulado
    const newVendasMes = randomDataArray(labelsMeses.length, 30000);
    chartVendasMes.data.datasets[0].data = newVendasMes;
    chartVendasMes.update();

    chartVendasAcumuladas.data.datasets[0].data = calcVendasAcumuladas(newVendasMes);
    chartVendasAcumuladas.update();

    chartProdutosMaisVendidos.data.datasets[0].data = randomDataArray(produtosLabels.length, 100);
    chartProdutosMaisVendidos.update();

    chartClientesAtivos.data.datasets[0].data = randomDataArray(clientesLabels.length, 20);
    chartClientesAtivos.update();

    chartFaturamentoPorCanal.data.datasets[0].data = randomDataArray(canaisLabels.length, 30000);
    chartFaturamentoPorCanal.update();

    chartFaturamentoMensal.data.datasets[0].data = randomDataArray(labelsMeses.length, 30000);
    chartFaturamentoMensal.update();
  }

  document.getElementById('filterBtn').addEventListener('click', () => {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    if (startDate && endDate && startDate > endDate) {
      alert('A data início não pode ser maior que a data fim.');
      return;
    }

    filtrarRelatorios(startDate, endDate);
  });
</script>

</body>
</html>
