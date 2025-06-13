require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // pegar dados do formulário
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmar'];

    // validações...

    if ($senha === $confirmar) {
        // criptografar senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // preparar e executar insert
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$nome, $email, $senhaHash]);
            $sucesso = 'Cadastro realizado com sucesso! Você já pode fazer login.';
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // código de violação de chave única
                $erro = 'Este email já está cadastrado.';
            } else {
                $erro = 'Erro no cadastro: ' . $e->getMessage();
            }
        }
    } else {
        $erro = 'As senhas não coincidem.';
    }
}
