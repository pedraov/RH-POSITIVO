<?php
require_once '../Controller/FuncionarioController.php';

$mensagem = "";

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $funcionarioController = new FuncionarioController();
    
    // Dados do formulário
    $dados = [
        'nome' => $_POST['nome'],
        'cargo' => $_POST['cargo'],
        'email' => $_POST['email'],
        'endereco' => $_POST['endereco'],
        'departamento' => 'Tecnologia' // ou outro departamento, se necessário
    ];

    // Chamar o método do Controller para adicionar o funcionário
    $mensagem = $funcionarioController->adicionarFuncionario($dados);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Funcionário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Barra de navegação superior -->
    <header>
        <div class="navbar">
            <span class="navbar-title">RH POSITIVO</span>
            <p class="date-time">14:32 &nbsp; 2/09/2024</p>
        </div>
    </header>

    <!-- Barra de filial -->
    <section class="branch-info">
        <span>Filial: 1</span>
        <span class="total-employees">Funcionários Ativos: 20</span>
    </section>

    <h1 style="margin-left: 150px; margin-top: 20px">Cadastrar Novo Funcionário</h1>
    

    <form method="POST" action="cadastrar_funcionario.php">
        <label for="nome">Nome do Funcionário:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="cargo">Cargo:</label>
        <input type="text" id="cargo" name="cargo" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>

        <button type="submit">Cadastrar Funcionário</button>
    </form>

    <div>
    <?php if ($mensagem): ?>
        <p id="mensagem"><?php echo $mensagem; ?></p>
    <?php endif; ?>
    </div>

    <!-- Rodapé com botões -->
    <footer>
        <button onclick="window.location.href='tecnologia.php'" class="footer-btn">Retornar</button>
        <button onclick="adicionarFuncionario()" class="footer-btn">Adicionar Funcionário</button>
    </footer>
</body>
</html>
