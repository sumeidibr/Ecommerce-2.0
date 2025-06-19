<?php
session_start();

// Check if admin is logged in


// Simulated data
$metrics = [
    'products' => [
        'total' => 125,
        'new_this_month' => 18,
        'low_stock' => 7
    ],
    'users' => [
        'total' => 87,
        'new_this_week' => 12,
        'active' => 72
    ],
    'orders' => [
        'total' => 63,
        'pending' => 8,
        'completed' => 55,
        'canceled' => 3
    ],
    'revenue' => [
        'monthly' => 28450,
        'weekly' => 8450,
        'daily_avg' => 1207
    ]
];

$sales_data = [
    'months' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul'],
    'values' => [1200, 1500, 1800, 1100, 2400, 3000, 2800]
];

// Dados simulados faturamento mensal por categoria para gráfico de linhas
$categories = ['Electronics', 'Fashion', 'Home & Kitchen', 'Beauty', 'Books'];
$category_revenue = [
    'Electronics' => [3000, 3500, 3200, 4000, 4500, 4800, 5000],
    'Fashion' => [2000, 2100, 2500, 2300, 2700, 3000, 2900],
    'Home & Kitchen' => [1500, 1600, 1700, 1800, 1900, 2000, 2100],
    'Beauty' => [1000, 1100, 1050, 1200, 1300, 1250, 1400],
    'Books' => [500, 700, 600, 750, 800, 900, 950]
];

$top_categories = [
    ['name' => 'Electronics', 'sales' => 42, 'revenue' => 18450],
    ['name' => 'Fashion', 'sales' => 38, 'revenue' => 12400],
    ['name' => 'Home & Kitchen', 'sales' => 29, 'revenue' => 8750],
    ['name' => 'Beauty', 'sales' => 22, 'revenue' => 6450],
    ['name' => 'Books', 'sales' => 15, 'revenue' => 3200]
];

$recent_orders = [
    ['id' => '#ORD-00125', 'customer' => 'Maria Silva', 'amount' => 'R$ 289,90', 'date' => '15/06/2023', 'status' => 'Completed'],
    ['id' => '#ORD-00124', 'customer' => 'Carlos Oliveira', 'amount' => 'R$ 149,50', 'date' => '15/06/2023', 'status' => 'Pending'],
    ['id' => '#ORD-00123', 'customer' => 'Ana Costa', 'amount' => 'R$ 520,00', 'date' => '14/06/2023', 'status' => 'Completed'],
    ['id' => '#ORD-00122', 'customer' => 'João Pereira', 'amount' => 'R$ 89,90', 'date' => '14/06/2023', 'status' => 'Canceled'],
    ['id' => '#ORD-00121', 'customer' => 'Fernanda Lima', 'amount' => 'R$ 325,75', 'date' => '13/06/2023', 'status' => 'Shipped']
];

$top_products = [
    ['name' => 'Wireless Headphones Pro', 'category' => 'Electronics', 'sales' => 42, 'stock' => 15],
    ['name' => 'Smart Watch Series 5', 'category' => 'Electronics', 'sales' => 38, 'stock' => 8],
    ['name' => 'Running Shoes', 'category' => 'Fashion', 'sales' => 31, 'stock' => 22],
    ['name' => 'Blender 1000W', 'category' => 'Home', 'sales' => 25, 'stock' => 12],
    ['name' => 'Organic Skincare Set', 'category' => 'Beauty', 'sales' => 23, 'stock' => 5]
];
?>

<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - E-commerce</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="adminDashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
</head>
<body>
 
  
  <!-- MAIN CONTENT -->
  <div class="main">
    <div class="header">
      <h1>Painel de Controle</h1>
      
      <div class="header-actions">
        <div class="user-info">
          <img src="https://ui-avatars.com/api/?name=Admin&background=3b82f6&color=fff" alt="Admin">
          <div class="user-details">
            <div class="name">Administrador</div>
            <div class="role">Admin</div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- STATS CARDS -->
    <div class="stats-grid">
      <div class="stat-card products">
        <div class="title">
          <i class="fas fa-box"></i>
          <h3>Produtos</h3>
        </div>
        <div class="value"><?= $metrics['products']['total'] ?></div>
        <div class="trend up">
          <i class="fas fa-arrow-up"></i>
          <?= $metrics['products']['new_this_month'] ?> novos este mês
        </div>
        <div class="trend down">
          <i class="fas fa-exclamation-circle"></i>
          <?= $metrics['products']['low_stock'] ?> com estoque baixo
        </div>
      </div>
      
      <div class="stat-card users">
        <div class="title">
          <i class="fas fa-users"></i>
          <h3>Usuários</h3>
        </div>
        <div class="value"><?= $metrics['users']['total'] ?></div>
        <div class="trend up">
          <i class="fas fa-arrow-up"></i>
          <?= $metrics['users']['new_this_week'] ?> novos esta semana
        </div>
        <div class="trend">
          <?= $metrics['users']['active'] ?> usuários ativos
        </div>
      </div>
      
      <div class="stat-card orders">
        <div class="title">
          <i class="fas fa-shopping-cart"></i>
          <h3>Pedidos</h3>
        </div>
        <div class="value"><?= $metrics['orders']['total'] ?></div>
        <div class="trend">
          <span class="status completed"><?= $metrics['orders']['completed'] ?> completos</span>
          <span class="status pending"><?= $metrics['orders']['pending'] ?> pendentes</span>
        </div>
        <div class="trend down">
          <i class="fas fa-times-circle"></i>
          <?= $metrics['orders']['canceled'] ?> cancelados
        </div>
      </div>
      
      <div class="stat-card revenue">
        <div class="title">
          <i class="fas fa-dollar-sign"></i>
          <h3>Receita</h3>
        </div>
        <div class="value"> <?= number_format($metrics['revenue']['monthly'], 0, ',', '.') ?> Mzn</div>
        <div class="trend up">
          <i class="fas fa-arrow-up"></i>
          <?= number_format($metrics['revenue']['daily_avg'], 0, ',', '.') ?> Mzn média diária
        </div>
        <div class="trend">
          Mzn <?= number_format($metrics['revenue']['weekly'], 0, ',', '.') ?> esta semana
        </div>
      </div>
    </div>
    
    <!-- CHARTS & REPORTS -->
    <div class="dashboard-content">
      <div class="charts">
        <!-- SALES CHART -->
        <div class="chart-container">
          <div class="chart-header">
            <h2><i class="fas fa-chart-line"></i> Vendas Mensais</h2>
            <div class="time-filter">
              <select>
                <option>Últimos 7 dias</option>
                <option selected>Últimos 30 dias</option>
                <option>Últimos 90 dias</option>
              </select>
            </div>
          </div>
          <div class="chart-wrapper">
            <canvas id="salesChart"></canvas>
          </div>
        </div>
        
        <!-- CATEGORY REVENUE CHART -->
        <div class="chart-container">
          <div class="chart-header">
            <h2><i class="fas fa-chart-pie"></i> Receita por Categoria</h2>
          </div>
          <div class="chart-wrapper">
            <canvas id="categoryChart"></canvas>
          </div>
        </div>
      </div>
      
      <div class="tables">
        <!-- RECENT ORDERS TABLE -->
        <div class="table-container">
          <div class="chart-header">
            <h2><i class="fas fa-receipt"></i> Pedidos Recentes</h2>
            <a href="#">Ver todos</a>
          </div>
          
          <table>
            <thead>
              <tr>
                <th>Pedido</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($recent_orders as $order): ?>
              <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['customer'] ?></td>
                <td><?= $order['amount'] ?></td>
                <td>
                  <?php 
                  $statusClass = strtolower($order['status']);
                  echo "<span class='status $statusClass'>$order[status]</span>";
                  ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        
        <!-- TOP PRODUCTS TABLE -->
        <div class="table-container">
          <div class="chart-header">
            <h2><i class="fas fa-star"></i> Produtos Mais Vendidos</h2>
            <a href="#">Ver todos</a>
          </div>
          
          <table>
            <thead>
              <tr>
                <th>Produto</th>
                <th>Vendas</th>
                <th>Estoque</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($top_products as $product): ?>
              <tr>
                <td><?= $product['name'] ?></td>
                <td><?= $product['sales'] ?></td>
                <td>
                  <?= $product['stock'] ?>
                  <?php if($product['stock'] < 10): ?>
                    <span class="stock-low">(Baixo)</span>
                  <?php elseif($product['stock'] == 0): ?>
                    <span class="stock-out">(Esgotado)</span>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Vendas Mensais - gráfico linha
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
      type: 'line',
      data: {
        labels: <?= json_encode($sales_data['months']) ?>,
        datasets: [{
          label: 'Vendas (Mzn)',
          data: <?= json_encode($sales_data['values']) ?>,
          borderColor: '#3b82f6',
          backgroundColor: 'rgba(59, 130, 246, 0.15)',
          borderWidth: 3,
          pointRadius: 6,
          pointBackgroundColor: '#fff',
          pointBorderColor: '#3b82f6',
          pointBorderWidth: 2,
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: true, labels: {color: '#333'} }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: 'rgba(0,0,0,0.05)' },
            ticks: {
              callback: function(value) {
                return 'Mzn ' + value.toLocaleString('pt-BR');
              }
            }
          },
          x: {
            grid: { display: false },
            ticks: { color: '#333' }
          }
        }
      }
    });

    // Faturamento Mensal por Categoria - gráfico linha múltiplo
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
      type: 'line',
      data: {
        labels: <?= json_encode($sales_data['months']) ?>,
        datasets: [
          <?php foreach($categories as $index => $category): 
            $colors = ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'];
          ?>
            {
              label: '<?= $category ?>',
              data: <?= json_encode($category_revenue[$category]) ?>,
              borderColor: '<?= $colors[$index % count($colors)] ?>',
              backgroundColor: '<?= substr($colors[$index % count($colors)], 0, -1) ?>0.15)',
              borderWidth: 2,
              pointRadius: 4,
              pointBackgroundColor: '<?= $colors[$index % count($colors)] ?>',
              tension: 0.3,
              fill: false
            }<?= $index < count($categories)-1 ? ',' : '' ?>
          <?php endforeach; ?>
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'right',
            labels: { color: '#333' }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return context.dataset.label + ': Mzn ' + context.parsed.y.toLocaleString('pt-BR');
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: 'rgba(0,0,0,0.05)' },
            ticks: {
              callback: function(value) {
                return 'Mzn ' + value.toLocaleString('pt-BR');
              }
            }
          },
          x: {
            grid: { display: false },
            ticks: { color: '#333' }
          }
        }
      }
    });
  </script>
</body>
</html>