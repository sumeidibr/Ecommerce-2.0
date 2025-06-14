<!-- sidebar.php -->
<style>
  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 220px;
    height: 100vh;
    background-color: #343a40;
    padding-top: 60px;
    color: white;
    z-index: 1000;
  }

  .sidebar a {
    display: block;
    padding: 15px 20px;
    color: #ccc;
    text-decoration: none;
    transition: 0.3s;
  }

  .sidebar a:hover,
  .sidebar a.active {
    background-color: #495057;
    color: #fff;
  }

  .sidebar h2 {
    text-align: center;
    padding-top: 15px;
    font-size: 20px;
    color: #fff;
    margin-bottom: 10px;
  }

  .content {
    margin-left: 220px;
    padding: 20px;
  }

  @media (max-width: 768px) {
    .sidebar {
      width: 100%;
      height: auto;
      position: relative;
    }

    .content {
      margin-left: 0;
    }
  }
</style>

<div class="sidebar">
  <h2>Admin</h2>
  <a href="adminDashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">📊 Dashboard</a>
  <a href="produtosAdmin.php" class="<?= basename($_SERVER['PHP_SELF']) == 'produtos.php' ? 'active' : '' ?>">🛍️ Produtos</a>
  <a href="pedidos.php" class="<?= basename($_SERVER['PHP_SELF']) == 'pedidos.php' ? 'active' : '' ?>">📦 Pedidos</a>
  <a href="clientes.php" class="<?= basename($_SERVER['PHP_SELF']) == 'clientes.php' ? 'active' : '' ?>">👥 Clientes</a>
  <a href="relatorios.php" class="<?= basename($_SERVER['PHP_SELF']) == 'relatorios.php' ? 'active' : '' ?>">📈 Relatórios</a>
  <a href="configuracoes.php" class="<?= basename($_SERVER['PHP_SELF']) == 'configuracoes.php' ? 'active' : '' ?>">⚙️ Configurações</a>
  <a href="logout.php">🚪 Sair</a>
</div>
