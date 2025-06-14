<?php
session_start();
require 'db.php'; // conexão com o banco

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!$email || !$senha) {
        $erro = 'Por favor, preencha todos os campos.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && $senha === $usuario['senha']) {
    // senha validada sem hash
    $_SESSION['usuario'] = [
        'id' => $usuario['id'],
        'nome' => $usuario['nome'],
        'email' => $usuario['email'],
        'tipo_usuario' => $usuario['tipo_usuario']
    ];

            if ($usuario['tipo_usuario'] === 'cliente') {
                header('Location: index.php');
            } if ($usuario['tipo_usuario'] === 'admin') {
                header('Location: adminDashboard.php');
            } else {
                header('Location: perfil.php');
            }
            exit;
        } else {
            $erro = 'Email ou senha incorretos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Gordanda Ecommerce</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #f8f9fa, #e9ecef);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card p-4">
        <h3 class="text-center mb-4">Bem-vindo de volta 👋</h3>

        <?php if ($erro): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
          <div class="mb-3">
            <label for="email" class="form-label">📧 Email</label>
            <input type="email" required class="form-control" id="email" name="email" placeholder="ex: seuemail@email.com">
          </div>

          <div class="mb-3">
            <label for="senha" class="form-label">🔒 Senha</label>
            <input type="password" required class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
          </div>

          <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>

        <p class="text-center mt-3">Não tem conta? <a href="registro.php">Criar conta</a></p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
