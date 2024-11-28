<?php
require_once '../Model/FuncionarioModel.php';

class FuncionarioController {
    private $model;

    public function __construct() {
        $this->model = new FuncionarioModel();
    }

    // Obter lista de funcionários de um departamento específico
    public function getFuncionariosByDepartamento($departamento) {
        return $this->model->buscarPorDepartamento($departamento);
    }

    public function adicionarFuncionario($dados) {
        // Validação básica dos dados do funcionário
        if (empty($dados['nome']) || empty($dados['cargo']) || empty($dados['email']) || empty($dados['endereco']) || empty($dados['departamento'])) {
            return "Todos os campos são obrigatórios.";
        }
    
        // Chamar o método de inserção na Model
        $resultado = $this->model->inserirFuncionario($dados);
        return $resultado ? "Funcionário adicionado com sucesso!" : "Erro ao adicionar funcionário.";
    }
    
    // Editar informações de um funcionário existente
    public function editarFuncionario($id, $dados) {
        // Validar dados de edição
        if (empty($dados['nome']) || empty($dados['cargo']) || empty($dados['email']) || empty($dados['endereco']) || empty($dados['departamento'])) {
            return "Nome e cargo são obrigatórios para edição.";
        }
        
        // Chamar o método de atualização na Model
        $resultado = $this->model->atualizarFuncionario($id, $dados);
        return $resultado ? "Funcionário atualizado com sucesso!" : "Erro ao atualizar funcionário.";
    }

    // Deletar um funcionário pelo ID
    public function deletarFuncionario($id) {
        // Chamar o método de exclusão na Model
        $resultado = $this->model->excluirFuncionario($id);
        return $resultado ? "Funcionário deletado com sucesso!" : "Erro ao deletar funcionário.";
    }

    public function obterFuncionarioPorId($id) {
        return $this->model->buscarFuncionarioPorId($id);
    }

    public function obterIddoFuncionario($name){
        return $this->model->buscarIdFuncionario($name);
    }

    public function excluirFuncionario($id) {
        $resultado = $this->model->excluirFuncionario($id);
        return $resultado ? "Funcionário excluído com sucesso!" : "Erro ao excluir funcionário.";
    }    
}