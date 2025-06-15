<!-- sidebar.php -->
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 240px;
    height: 100vh;
    background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
    padding-top: 70px;
    color: #e0e7ff;
    font-family: 'Inter', sans-serif;
    box-shadow: 3px 0 10px rgba(0,0,0,0.3);
    z-index: 1000;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .sidebar h2 {
    text-align: center;
    font-size: 24px;
    font-weight: 700;
    color: #a5b4fc;
    margin-bottom: 25px;
    user-select: none;
  }

  .sidebar a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 24px;
    color: #cbd5e1;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    border-radius: 8px;
    transition: background-color 0.3s ease, color 0.3s ease;
    cursor: pointer;
    user-select: none;
  }

  .sidebar a:hover {
    background-color: #4338ca; /* Indigo */
    color: #f0f9ff;
    box-shadow: 0 4px 12px rgba(67, 56, 202, 0.5);
  }

  .sidebar a.active {
    background-color: #6366f1; /* Indigo 400 */
    color: white;
    font-weight: 600;
    box-shadow: 0 0 12px #6366f1;
    position: relative;
  }

  .sidebar a.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 12px;
    height: 28px;
    width: 4px;
    background: #818cf8;
    border-radius: 0 4px 4px 0;
  }

  /* Ícones em emojis ficam grandes e meio amadores, podemos usar SVG inline ou fontes de ícones, mas vou manter emojis só com tamanho menor */
  .sidebar a span.icon {
    font-size: 18px;
    line-height: 1;
    user-select: none;
  }

  /* Responsividade */
  @media (max-width: 768px) {
    .sidebar {
      position: relative;
      width: 100%;
      height: auto;
      padding-top: 15px;
      flex-direction: row;
      justify-content: space-around;
      box-shadow: none;
    }

    .sidebar h2 {
      display: none;
    }

    .sidebar a {
      padding: 10px 12px;
      font-size: 14px;
      border-radius: 6px;
    }

    .sidebar a.active::before {
      display: none;
    }
  }
</style>

<div class="sidebar">
  <h2>Admin</h2>
  <a href="adminDashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'adminDashboard.php' ? 'active' : '' ?>">
    <span class="icon">📊</span> Dashboard
  </a>
  <a href="produtosAdmin.php" class="<?= basename($_SERVER['PHP_SELF']) == 'produtosAdmin.php' ? 'active' : '' ?>">
    <span class="icon">🛍️</span> Produtos
  </a>
  <a href="pedidos.php" class="<?= basename($_SERVER['PHP_SELF']) == 'pedidos.php' ? 'active' : '' ?>">
    <span class="icon">📦</span> Pedidos
  </a>
  <a href="clientes.php" class="<?= basename($_SERVER['PHP_SELF']) == 'clientes.php' ? 'active' : '' ?>">
    <span class="icon">👥</span> Clientes
  </a>
  <a href="relatorios.php" class="<?= basename($_SERVER['PHP_SELF']) == 'relatorios.php' ? 'active' : '' ?>">
    <span class="icon">📈</span> Relatórios
  </a>
  <a href="configuracoes.php" class="<?= basename($_SERVER['PHP_SELF']) == 'configuracoes.php' ? 'active' : '' ?>">
    <span class="icon">⚙️</span> Configurações
  </a>
  <a href="logout.php">
    <span class="icon">🚪</span> Sair
  </a>
</div>
