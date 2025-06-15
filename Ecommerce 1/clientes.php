<?php
// sidebar.php simulado dentro deste arquivo para exemplo
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Clientes - Lista de Usuários</title>
<style>
  /* Reset básico */
  * {
    box-sizing: border-box;
  }
  body, html {
    margin: 0; padding: 0;
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9fafb;
    color: #333;
  }

  /* --- Sidebar --- */
  .sidebar {
    width: 250px;
    background: #1e40af; /* azul escuro */
    color: white;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    padding: 20px;
    box-sizing: border-box;
    overflow-y: auto;
  }
  .sidebar h2 {
    margin-top: 0;
    font-weight: 700;
  }
  .sidebar nav a {
    display: block;
    color: white;
    text-decoration: none;
    margin: 15px 0;
    font-weight: 600;
    transition: color 0.3s;
  }
  .sidebar nav a:hover {
    color: #93c5fd; /* azul claro */
  }

  /* --- Container principal ao lado da sidebar --- */
  .container {
    margin-left: 250px; /* abre espaço para sidebar fixa */
    padding: 20px 30px;
    max-width: calc(100% - 250px);
    display: flex;
    gap: 30px;
    height: 100vh;
    overflow: hidden;
  }

  /* Conteúdo principal: lista de usuários */
  .main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  h1 {
    margin-top: 0;
    margin-bottom: 15px;
    color: #2563eb;
  }

  /* Caixa de busca */
  .search-box {
    margin-bottom: 20px;
  }
  .search-box input[type="search"] {
    width: 320px;
    max-width: 100%;
    padding: 12px 20px;
    border: 2px solid #2563eb;
    border-radius: 30px;
    font-size: 16px;
    transition: border-color 0.3s;
  }
  .search-box input[type="search"]:focus {
    border-color: #1d4ed8;
    outline: none;
  }

  /* Tabela */
  table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    flex-grow: 1;
    display: block;
    overflow-y: auto;
  }
  thead {
    background-color: #2563eb;
    color: white;
    display: table;
    width: 100%;
    table-layout: fixed;
  }
  thead tr {
    display: table-row;
  }
  thead th {
    padding: 15px 20px;
    text-align: left;
    font-weight: 600;
    font-size: 0.95rem;
  }
  tbody {
    display: block;
    max-height: 400px; /* altura com scroll */
    overflow-y: auto;
    width: 100%;
  }
  tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
    cursor: pointer;
  }
  tbody tr:hover {
    background-color: #eff6ff;
  }
  tbody td {
    padding: 15px 20px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 0.9rem;
    word-wrap: break-word;
  }

  /* Painel detalhes fixo à direita */
  .detail-panel {
    flex: 0 0 350px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    padding: 25px 30px;
    font-size: 1rem;
    color: #111827;
    position: sticky;
    top: 20px;
    height: fit-content;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
  }
  .detail-panel h2 {
    margin-top: 0;
    color: #1e40af;
    margin-bottom: 15px;
  }
  .detail-panel p {
    margin: 8px 0;
  }
  .detail-label {
    font-weight: 700;
    color: #2563eb;
  }
  .status {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 700;
    color: white;
  }
  .status.Ativo {
    background-color: #10b981;
  }
  .status.Inativo {
    background-color: #ef4444;
  }

  /* Destaque linha selecionada */
  tbody tr.selected {
    background-color: #dbeafe;
  }

  /* Responsividade */
  @media (max-width: 900px) {
    body {
      flex-direction: column;
    }
    .sidebar {
      position: relative;
      width: 100%;
      height: auto;
    }
    .container {
      margin-left: 0;
      flex-direction: column;
      max-width: 100%;
      padding: 10px 15px;
      height: auto;
    }
    .detail-panel {
      position: relative;
      top: auto;
      max-height: none;
      margin-top: 30px;
      flex: none;
      width: 100%;
    }
    table, thead, tbody, tr, td, th {
      display: block;
      width: 100%;
    }
    thead tr {
      position: absolute;
      top: -9999px;
      left: -9999px;
    }
    tbody tr {
      margin-bottom: 15px;
      border: 1px solid #ddd;
      padding: 10px;
      cursor: pointer;
    }
    tbody td {
      border: none;
      padding-left: 50%;
      position: relative;
      text-align: left;
      font-size: 0.9rem;
    }
    tbody td::before {
      position: absolute;
      left: 15px;
      top: 15px;
      white-space: nowrap;
      font-weight: 600;
      color: #2563eb;
    }
    tbody td:nth-of-type(1)::before { content: "ID"; }
    tbody td:nth-of-type(2)::before { content: "Nome"; }
    tbody td:nth-of-type(3)::before { content: "Email"; }
    tbody td:nth-of-type(4)::before { content: "Status"; }
    tbody td:nth-of-type(5)::before { content: "Registro"; }
  }
</style>
</head>
<body>

<?php include('sidebar.php'); ?>




<?php
// Dados exemplo (substitua pelo seu source real)
$users = [
    ['id' => 1, 'name' => 'Maria Silva', 'email' => 'maria@example.com', 'status' => 'Ativo', 'registered' => '2023-01-15', 'phone' => '(84) 91234-5678', 'address' => 'Rua A, 123'],
    ['id' => 2, 'name' => 'João Pereira', 'email' => 'joao@example.com', 'status' => 'Inativo', 'registered' => '2023-03-22', 'phone' => '(84) 98765-4321', 'address' => 'Av. B, 456'],
    ['id' => 3, 'name' => 'Fernanda Lima', 'email' => 'fernanda@example.com', 'status' => 'Ativo', 'registered' => '2023-02-10', 'phone' => '(84) 91234-9999', 'address' => 'Travessa C, 789'],
    ['id' => 4, 'name' => 'Carlos Oliveira', 'email' => 'carlos@example.com', 'status' => 'Ativo', 'registered' => '2023-04-05', 'phone' => '(84) 93456-7777', 'address' => 'Rua D, 321'],
    ['id' => 5, 'name' => 'Ana Costa', 'email' => 'ana@example.com', 'status' => 'Ativo', 'registered' => '2023-05-18', 'phone' => '(84) 92345-8888', 'address' => 'Av. E, 654'],
];
?>

<div class="container">

  <section class="main-content">
    <h1>Clientes</h1>

    <div class="search-box">
      <input type="search" id="searchInput" placeholder="Pesquisar clientes pelo nome ou email..." onkeyup="filterUsers()" />
    </div>

    <table id="userTable" aria-label="Tabela de usuários">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Status</th>
          <th>Registro</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $user): ?>
        <tr 
          data-id="<?= $user['id'] ?>"
          data-name="<?= htmlspecialchars($user['name']) ?>"
          data-email="<?= htmlspecialchars($user['email']) ?>"
          data-status="<?= $user['status'] ?>"
          data-registered="<?= date('d/m/Y', strtotime($user['registered'])) ?>"
          data-phone="<?= htmlspecialchars($user['phone']) ?>"
          data-address="<?= htmlspecialchars($user['address']) ?>"
          onclick="showUserDetails(this)"
        >
          <td><?= $user['id'] ?></td>
          <td><?= htmlspecialchars($user['name']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><span class="status <?= $user['status'] ?>"><?= $user['status'] ?></span></td>
          <td><?= date('d/m/Y', strtotime($user['registered'])) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>

  <aside class="detail-panel" id="detailPanel">
    <h2>Selecione um usuário</h2>
    <p><em>Clique em uma linha da tabela para ver os detalhes aqui.</em></p>
  </aside>

</div>

<script>
  function filterUsers() {
    const filter = document.getElementById('searchInput').value.toLowerCase();

    document.querySelectorAll('#userTable tbody tr').forEach(row => {
      const name = row.getAttribute('data-name').toLowerCase();
      const email = row.getAttribute('data-email').toLowerCase();
      row.style.display = (name.includes(filter) || email.includes(filter)) ? '' : 'none';
    });
  }

  function showUserDetails(row) {
    const panel = document.getElementById('detailPanel');
    const id = row.getAttribute('data-id');
    const name = row.getAttribute('data-name');
    const email = row.getAttribute('data-email');
    const status = row.getAttribute('data-status');
    const registered = row.getAttribute('data-registered');
    const phone = row.getAttribute('data-phone');
    const address = row.getAttribute('data-address');

    panel.innerHTML = `
      <h2>${name}</h2>
      <p><span class="detail-label">ID:</span> ${id}</p>
      <p><span class="detail-label">Email:</span> ${email}</p>
      <p><span class="detail-label">Telefone:</span> ${phone}</p>
      <p><span class="detail-label">Endereço:</span> ${address}</p>
      <p><span class="detail-label">Status:</span> <span class="status ${status}">${status}</span></p>
      <p><span class="detail-label">Data de Registro:</span> ${registered}</p>
    `;

    // Remove destaque anterior e aplica no selecionado
    document.querySelectorAll('#userTable tbody tr').forEach(r => r.classList.remove('selected'));
    row.classList.add('selected');
  }
</script>

</body>
</html>
