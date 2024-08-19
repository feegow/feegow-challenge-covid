<?php

namespace service;

use model\Funcionario;
use repository\FuncionarioRepository;

require_once "Database.php";

class FuncionarioService
{
    private $funcionario;

    private $funcionarioRepository;


    public function __construct(?Funcionario $funcionario, FuncionarioRepository $funcionarioRepository)
    {
        $this->funcionario = $funcionario;
        $this->funcionarioRepository = $funcionarioRepository;
    }

    public function getFuncionarios()
    {
        return $this->funcionarioRepository->findAll();
    }

    public function createFuncionario()
    {
        $this->funcionarioRepository->create($this->funcionario);
    }

    public function editFuncionario()
    {
        $this->funcionarioRepository->update($this->funcionario);
    }

    public function deleteFuncionario(string $cpf)
    {
        $this->funcionarioRepository->delete($cpf);
    }

    public function showFuncionario($cpf)
    {
       return $this->funcionarioRepository->findById($cpf);
    }
}
