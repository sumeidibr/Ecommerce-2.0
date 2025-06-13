<?php
session_start();

// Simulação do usuário logado (depois buscar do banco)
$usuario = [
  'nome' => 'Maria Silva',
  'email' => 'maria.silva@email.com',
  'telefone' => '+258 84 123 4567',
  'endereco' => 'Rua 25 de Setembro, Nº 45, Maputo'
];
?>

<?php include('includes/header.php'); ?>

<div class="container mt-5">
  <h2>Meu Perfil</h2>

  <div class="card p-4 shadow-sm" style="max-width: 600px;">
    <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
    <p><strong>Telefone:</strong> <?= htmlspecialchars($usuario['telefone']) ?></p>
    <p><strong>Endereço:</strong> <?= htmlspecialchars($usuario['endereco']) ?></p>

    <a href="editar_perfil.php" class="btn btn-primary mt-3">Editar Perfil</a>
  </div>
</div>

<?php include('includes/footer.php'); ?>
