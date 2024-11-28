<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RH POSITIVO - Departamento de Tecnologia</title>
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

    <!-- Lista de funcionários -->
    <main>
        <h2 style="margin-top:20px">Funcionários do Departamento de Tecnologia</h2>
        <ul class="employee-list">
            <?php
                // Include do arquivo do Controller
                require_once '../Controller/FuncionarioController.php';

                // Instanciando o Controller e requisitando a lista de funcionários
                $funcionarioController = new FuncionarioController();
                $funcionarios = $funcionarioController->getFuncionariosByDepartamento('Tecnologia');

                // Exibindo os funcionários na lista
                foreach ($funcionarios as $funcionario) {
                    ?><li class="list-itens"><?php
                    echo "<span>" . htmlspecialchars($funcionario['nome']) . "</span> - ";
                    echo "<span>" . htmlspecialchars($funcionario['cargo']) . "</span>";
                    echo "<button onclick=\"abrirModal(" . htmlspecialchars($funcionario['id']) . ")\">Opções</button>";
                    ?></li><?php
                }
            ?>
        </ul>
    </main>

    <!-- Modal de opções do funcionário -->
    <div id="opcoesModal">
        <div class="modal-content">
            <h3>Opções do Funcionário</h3>
            <!-- Adicionando ID do funcionário selecionado como dado para o modal -->
            <?php 
                if (isset($funcionarios['nome'])) {
                    $funcionarioid = $funcionarioController->obterIddoFuncionario($funcionarios['nome']);
                }
            ?>
            <input type="hidden" id="funcionarioId" value="<?php echo htmlspecialchars($funcionarioid); ?>">
            <button onclick="avaliarFuncionario()">Avaliar Funcionário</button>
            <button onclick="editarInformacoes()">Editar Informações</button>
            <button onclick="desligarFuncionario()">Desligar Funcionário</button>
            <button onclick="fecharModal()">Fechar</button>
        </div>
    </div>

    <!-- Rodapé com botões -->
    <footer>
        <button onclick="window.location.href='index.html'" class="footer-btn">Retornar</button>
        <button onclick="adicionarFuncionario()" class="footer-btn">Adicionar Funcionário</button>
        <button class="footer-btn">Folha de Pagamento</button>
        <button class="footer-btn">Controle de Presença</button>
    </footer>


    <script>

        function avaliarFuncionario() {
            // Redirecionar para a página de avaliação do funcionário com o ID
            const id = document.getElementById('funcionarioId').value;
            window.location.href = `avaliar.php?id=${id}`;
        }

        function editarInformacoes() {
            // Confirma o id e redireciona para a edição
            const id = document.getElementById('funcionarioId').value;
            if (id) {
                window.location.href = `editar_funcionario.php?id=${id}`;
            } else {
                alert("ID do funcionário não encontrado.");
            }
        }


        function desligarFuncionario() {
            // Confirmar desligamento do funcionário e redirecionar para a exclusão
            const id = document.getElementById('funcionarioId').value;
            if (confirm("Tem certeza que deseja desligar este funcionário?")) {
                window.location.href = `excluir_funcionario.php?id=${id}`;
            }
        }

        function adicionarFuncionario() {
            // Redirecionar para a página de adição de novo funcionário
            window.location.href = 'cadastrar_funcionario.php';
        }

        // Função para abrir o modal
        function abrirModal(funcionarioId) {
            document.getElementById('funcionarioId').value = funcionarioId; // Armazena o ID do funcionário no input hidden
            document.getElementById('opcoesModal').style.display = 'flex'; // Use 'flex' para centralizar
            localStorage.setItem('modalAberto', 'true'); // Salva o estado do modal
        }

        // Função para fechar o modal
        function fecharModal() {
            document.getElementById('opcoesModal').style.display = 'none';
            localStorage.setItem('modalAberto', 'false'); // Atualiza o estado do modal
        }

        // Verifica o estado do modal ao carregar a página
        window.onload = function() {
            // Verifica se o modal não foi definido antes
            if (localStorage.getItem('modalAberto') === null) {
                localStorage.setItem('modalAberto', 'false'); // Define o estado inicial como 'false'
            }

            // Se o modal estiver salvo como "true", abra-o
            if (localStorage.getItem('modalAberto') === 'true') {
                abrirModal(); // Abre o modal se estiver salvo como aberto
            } else {
                fecharModal(); // Garante que o modal esteja fechado se o estado for "false"
            }
        }


    </script>
</body>
</html>
