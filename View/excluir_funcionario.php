<?php
require_once '../Controller/FuncionarioController.php';

$mensagem = "";
$funcionarioController = new FuncionarioController();

// Verificar se o ID do funcionário foi enviado na URL
if (isset($_GET['id'])) {
    $idFuncionario = $_GET['id'];
    
    // Verificar se o formulário de confirmação foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mensagem = $funcionarioController->excluirFuncionario($idFuncionario);
    }
} else {
    $mensagem = "Funcionário não encontrado.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Funcionário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Barra de navegação superior -->
    <header>
        <div class="navbar">
            <span class="navbar-title">RH POSITIVO</span>
            <p class="date-time">14:32 &nbsp; 2/09/2024</p>
        </div>
        <!-- Barra de filial -->
        <section class="branch-info">
            <span>Filial: 1</span>
            <span class="total-employees">Funcionários Ativos: 20</span>
        </section>
    </header>

    <div class="delete_employ">
    <h1>Excluir Funcionário</h1>
    <?php if ($mensagem): ?>
        <p><?php echo $mensagem; ?></p>
    <?php else: ?>
        <p>Tem certeza de que deseja excluir este funcionário?</p>
            <form class="confirm_button" method="POST" action="excluir_funcionario.php?id=<?php echo $idFuncionario; ?>">
                <button type="submit">Confirmar Exclusão</button>
            </form>
    <?php endif; ?>
    </div>

    <footer>
        <button onclick="window.location.href='tecnologia.php'" class="footer-btn">Retornar</button>
    </footer>
</body>
</html>
