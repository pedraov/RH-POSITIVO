<?php

include_once '../Config/database.php';

class FuncionarioModel {
    private $db;

    public function __construct() {
        global $pdo;
        $this->db = $pdo;
    }

    // Buscar funcionários por departamento
    public function buscarPorDepartamento($departamento) {
        $sql = "SELECT * FROM funcionarios WHERE departamento = :departamento";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserir um novo funcionário
    public function inserirFuncionario($dados) {
        $sql = "INSERT INTO funcionarios (nome, cargo, email, endereco, departamento) 
                VALUES (:nome, :cargo, :email, :endereco, :departamento)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':cargo', $dados['cargo']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':endereco', $dados['endereco']);
        $stmt->bindParam(':departamento', $dados['departamento']);
    
        return $stmt->execute();
    }

    // Excluir um funcionário
    public function excluirFuncionario($id) {
        $sql = "DELETE FROM funcionarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Buscar funcionário por ID
    public function buscarFuncionarioPorId($id) {
        $sql = "SELECT * FROM funcionarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Atualizar informações do funcionário
    public function atualizarFuncionario($dados) {
        $sql = "UPDATE funcionarios SET nome = :nome, cargo = :cargo, email = :email, endereco = :endereco 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':cargo', $dados['cargo']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':endereco', $dados['endereco']);
        $stmt->bindParam(':id', $dados['id']);
    
        return $stmt->execute();
    }

    public function buscarIdFuncionario($name){
        $sql = "SELECT id FROM funcionarios WHERE nome = :name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
