<?php
// Configurações iniciais e autenticação
session_start();


// Simulação de dados para o dashboard
$dados = [
    'vendas' => [
        'total' => 12890,
        'mes_atual' => 7520,
        'crescimento' => 12.5
    ],
    'pedidos' => [
        'novos' => 24,
        'pendentes' => 8,
        'concluidos' => 42
    ],
    'clientes' => [
        'total' => 845,
        'novos_mes' => 68,
        'taxa_retorno' => 72.3
    ],
    'produtos' => [
        'total' => 156,
        'estoque_baixo' => 12,
        'sem_estoque' => 3
    ],
    'pedidos_recentes' => [
        ['id' => '#ORD-001', 'cliente' => 'Maria Silva', 'valor' => 'R$ 289,90', 'data' => '15/06/2025', 'status' => 'Concluído'],
        ['id' => '#ORD-002', 'cliente' => 'João Pereira', 'valor' => 'R$ 149,50', 'data' => '15/06/2025', 'status' => 'Pendente'],
        ['id' => '#ORD-003', 'cliente' => 'Ana Costa', 'valor' => 'R$ 520,00', 'data' => '14/06/2025', 'status' => 'Concluído'],
        ['id' => '#ORD-004', 'cliente' => 'Carlos Oliveira', 'valor' => 'R$ 89,90', 'data' => '14/06/2025', 'status' => 'Cancelado'],
        ['id' => '#ORD-005', 'cliente' => 'Fernanda Lima', 'valor' => 'R$ 325,75', 'data' => '13/06/2025', 'status' => 'Concluído']
    ],
    'produtos_populares' => [
        ['nome' => 'Smartphone X', 'vendas' => 42, 'estoque' => 15],
        ['nome' => 'Fone Bluetooth Pro', 'vendas' => 38, 'estoque' => 8],
        ['nome' => 'Smart Watch Series 5', 'vendas' => 31, 'estoque' => 22],
        ['nome' => 'Tablet Ultra Slim', 'vendas' => 25, 'estoque' => 12],
        ['nome' => 'Caixa de Som Portátil', 'vendas' => 23, 'estoque' => 5]
    ]
];

// Funções utilitárias
function formatarMoeda($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

function getStatusClass($status) {
    switch ($status) {
        case 'Concluído': return 'status-concluido';
        case 'Pendente': return 'status-pendente';
        case 'Cancelado': return 'status-cancelado';
        default: return '';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - E-commerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --cor-primaria: #4361ee;
            --cor-secundaria: #3f37c9;
            --cor-sucesso: #4cc9f0;
            --cor-alerta: #f72585;
            --cor-aviso: #f8961e;
            --cor-texto: #333;
            --cor-texto-claro: #6c757d;
            --cor-fundo: #f8f9fa;
            --cor-borda: #dee2e6;
            --sombra: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--cor-fundo);
            color: var(--cor-texto);
            display: flex;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, var(--cor-primaria), var(--cor-secundaria));
            color: white;
            height: 100vh;
            position: fixed;
            padding: 20px 0;
            box-shadow: var(--sombra);
            z-index: 100;
        }
        
        .logo {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }
        
        .logo h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .menu {
            list-style: none;
            padding: 0 15px;
        }
        
        .menu li {
            margin-bottom: 5px;
        }
        
        .menu a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .menu a:hover, .menu a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .menu i {
            margin-right: 10px;
            width: 25px;
            text-align: center;
        }
        
        /* Conteúdo Principal */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--cor-borda);
        }
        
        .header h2 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--cor-primaria);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .user-details {
            text-align: right;
        }
        
        .user-details .name {
            font-weight: 600;
        }
        
        .user-details .role {
            font-size: 0.85rem;
            color: var(--cor-texto-claro);
        }
        
        /* Cards de Métricas */
        .metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .metric-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--sombra);
            display: flex;
            align-items: center;
            transition: transform 0.3s;
        }
        
        .metric-card:hover {
            transform: translateY(-5px);
        }
        
        .metric-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }
        
        .metric-icon.vendas { background-color: rgba(67, 97, 238, 0.15); color: var(--cor-primaria); }
        .metric-icon.pedidos { background-color: rgba(76, 201, 240, 0.15); color: var(--cor-sucesso); }
        .metric-icon.clientes { background-color: rgba(248, 150, 30, 0.15); color: var(--cor-aviso); }
        .metric-icon.produtos { background-color: rgba(247, 37, 133, 0.15); color: var(--cor-alerta); }
        
        .metric-info h3 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        
        .metric-info p {
            color: var(--cor-texto-claro);
            font-size: 0.9rem;
        }
        
        .metric-change {
            display: flex;
            align-items: center;
            margin-top: 5px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .metric-change.positive { color: #28a745; }
        .metric-change.negative { color: #dc3545; }
        
        /* Gráficos e Tabelas */
        .dashboard-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
        
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--sombra);
            margin-bottom: 20px;
        }
        
        .chart-container h3 {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--cor-borda);
            color: var(--cor-primaria);
        }
        
        .chart-wrapper {
            height: 300px;
            position: relative;
        }
        
        .tables {
            display: grid;
            gap: 20px;
        }
        
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--sombra);
        }
        
        .table-container h3 {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--cor-borda);
            color: var(--cor-primaria);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--cor-borda);
        }
        
        th {
            font-weight: 600;
            color: var(--cor-texto-claro);
            font-size: 0.9rem;
        }
        
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .status-concluido { background-color: rgba(40, 167, 69, 0.15); color: #28a745; }
        .status-pendente { background-color: rgba(255, 193, 7, 0.15); color: #ffc107; }
        .status-cancelado { background-color: rgba(220, 53, 69, 0.15); color: #dc3545; }
        
        .estoque-baixo { color: var(--cor-aviso); font-weight: 600; }
        .sem-estoque { color: var(--cor-alerta); font-weight: 600; }
        
        /* Responsividade */
        @media (max-width: 992px) {
            .dashboard-content {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar .logo h1, .menu span {
                display: none;
            }
            
            .menu i {
                margin-right: 0;
                font-size: 1.2rem;
            }
            
            .menu a {
                justify-content: center;
                padding: 15px;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .user-details {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h1><i class="fas fa-store"></i> AdminStore</h1>
        </div>
        
        <ul class="menu">
            <li><a href="#" class="active"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="#"><i class="fas fa-shopping-cart"></i> <span>Pedidos</span></a></li>
            <li><a href="#"><i class="fas fa-box-open"></i> <span>Produtos</span></a></li>
            <li><a href="#"><i class="fas fa-users"></i> <span>Clientes</span></a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> <span>Relatórios</span></a></li>
            <li><a href="#"><i class="fas fa-cog"></i> <span>Configurações</span></a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> <span>Sair</span></a></li>
        </ul>
    </div>
    
    <!-- Conteúdo Principal -->
    <div class="main-content">
        <div class="header">
            <h2>Dashboard</h2>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin">
                <div class="user-details">
                    <div class="name">Administrador</div>
                    <div class="role">Admin</div>
                </div>
            </div>
        </div>
        
        <!-- Cards de Métricas -->
        <div class="metrics">
            <div class="metric-card">
                <div class="metric-icon vendas">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="metric-info">
                    <h3><?= formatarMoeda($dados['vendas']['total']) ?></h3>
                    <p>Vendas Totais</p>
                    <div class="metric-change positive">
                        <i class="fas fa-arrow-up"></i> <?= $dados['vendas']['crescimento'] ?>% este mês
                    </div>
                </div>
            </div>
            
            <div class="metric-card">
                <div class="metric-icon pedidos">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="metric-info">
                    <h3><?= $dados['pedidos']['concluidos'] ?></h3>
                    <p>Pedidos Concluídos</p>
                    <div class="metric-change positive">
                        <i class="fas fa-arrow-up"></i> 8% este mês
                    </div>
                </div>
            </div>
            
            <div class="metric-card">
                <div class="metric-icon clientes">
                    <i class="fas fa-users"></i>
                </div>
                <div class="metric-info">
                    <h3><?= $dados['clientes']['total'] ?></h3>
                    <p>Total de Clientes</p>
                    <div class="metric-change positive">
                        <i class="fas fa-arrow-up"></i> <?= $dados['clientes']['novos_mes'] ?> novos
                    </div>
                </div>
            </div>
            
            <div class="metric-card">
                <div class="metric-icon produtos">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="metric-info">
                    <h3><?= $dados['produtos']['total'] ?></h3>
                    <p>Total de Produtos</p>
                    <div class="metric-change negative">
                        <i class="fas fa-exclamation-circle"></i> <?= $dados['produtos']['estoque_baixo'] ?> com estoque baixo
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Gráficos e Tabelas -->
        <div class="dashboard-content">
            <div class="charts">
                <div class="chart-container">
                    <h3>Vendas Mensais (Últimos 6 meses)</h3>
                    <div class="chart-wrapper">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
                
                <div class="chart-container">
                    <h3>Categorias de Produtos Mais Vendidas</h3>
                    <div class="chart-wrapper">
                        <canvas id="categoriesChart"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="tables">
                <div class="table-container">
                    <h3>Pedidos Recentes</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                                <th>Data</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados['pedidos_recentes'] as $pedido): ?>
                            <tr>
                                <td><?= $pedido['id'] ?></td>
                                <td><?= $pedido['cliente'] ?></td>
                                <td><?= $pedido['valor'] ?></td>
                                <td><?= $pedido['data'] ?></td>
                                <td><span class="status <?= getStatusClass($pedido['status']) ?>"><?= $pedido['status'] ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="table-container">
                    <h3>Produtos Populares</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Vendas</th>
                                <th>Estoque</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados['produtos_populares'] as $produto): ?>
                            <tr>
                                <td><?= $produto['nome'] ?></td>
                                <td><?= $produto['vendas'] ?></td>
                                <td class="<?= $produto['estoque'] < 10 ? 'estoque-baixo' : '' ?>">
                                    <?= $produto['estoque'] ?>
                                    <?= $produto['estoque'] == 0 ? '<span class="sem-estoque">(Sem estoque)</span>' : '' ?>
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
        // Gráfico de Vendas Mensais
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
                datasets: [{
                    label: 'Vendas (R$)',
                    data: [8500, 10200, 9800, 11000, 12500, 14200],
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // Gráfico de Categorias
        const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
        const categoriesChart = new Chart(categoriesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Eletrônicos', 'Moda', 'Casa', 'Beleza', 'Esportes'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: [
                        '#4361ee',
                        '#4cc9f0',
                        '#f8961e',
                        '#f72585',
                        '#38b000'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>