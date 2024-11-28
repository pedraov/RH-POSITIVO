<?php
require_once '../Controller/FuncionarioController.php';

$mensagem = "";
$funcionario = null;
$funcionarioController = new FuncionarioController();

// Verificar se o ID do funcionário foi enviado na URL
if (isset($_GET['id'])) {
    $idFuncionario = $_GET['id'];
    $funcionario = $funcionarioController->obterFuncionarioPorId($idFuncionario);
} else {
    echo "ID do funcionário não foi passado.";
}

// Verificar se o formulário foi enviado para atualizar os dados do funcionário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dadosAtualizados = [
        'nome' => $_POST['nome'],
        'cargo' => $_POST['cargo'],
        'email' => $_POST['email'],
        'endereco' => $_POST['endereco']
    ];
    
    $mensagem = $funcionarioController->editarFuncionario($idFuncionario, $dadosAtualizados);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Funcionário</h1>
    <?php if ($mensagem): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <?php if ($funcionario): ?>
    <form method="POST" action="editar_funcionario.php">
        <label for="nome">Nome do Funcionário:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $funcionario['nome']; ?>" required>

        <label for="cargo">Cargo:</label>
        <input type="text" id="cargo" name="cargo" value="<?php echo $funcionario['cargo']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $funcionario['email']; ?>" required>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo $funcionario['endereco']; ?>" required>

        <button type="submit">Salvar Alterações</button>
    </form>
    <?php else: ?>
        <p>Funcionário não encontrado.</p>
    <?php endif; ?>
</body>
</html>
