<?php
namespace controller;

use builder\FuncionarioBuilder;
use service\FuncionarioService;
use repository\FuncionarioRepository;

require_once '../service/FuncionarioService.php';
require_once '../repository/FuncionarioRepository.php';
require_once '../builder/FuncionarioBuilder.php';

class GerenciamentoController
{
    public function novoFuncionario()
    {
        try {
            $funcionarioRepository = new FuncionarioRepository();
            $funcionarioBuilder = new FuncionarioBuilder();

            $funcionario = $funcionarioBuilder->modelBuild($_POST);
            $funcionarioService = new FuncionarioService($funcionario, $funcionarioRepository);
            $funcionarioService->createFuncionario();

            header("Location: ../views/funcionario/funcionarios.php?status=created");
        } catch (\Exception $e) {
            header("Location: ../views/funcionario/funcionarios.php?status=error");
        }
    }

    public function editarFuncionario()
    {
        try {
            $funcionarioRepository = new FuncionarioRepository();
            $funcionarioBuilder = new FuncionarioBuilder();

            $funcionario = $funcionarioBuilder->modelBuild($_POST);
            $funcionarioService = new FuncionarioService($funcionario, $funcionarioRepository);

            $funcionarioService->editFuncionario();

            header("Location: ../views/funcionario/funcionarios.php?status=edited");
        } catch (\Exception $e) {
            header("Location: ../views/funcionario/funcionarios.php?status=error");
        }
    }

    public function deletarFuncionario()
    {
         try {
             $funcionarioRepository = new FuncionarioRepository();
             $funcionarioService = new FuncionarioService(null, $funcionarioRepository);

             $funcionarioService->deleteFuncionario($_REQUEST['cpf']);

             header("Location: ../views/funcionario/funcionarios.php?status=deleted");
         } catch (\Exception $e) {
             header("Location: ../views/funcionario/funcionarios.php?status=error");
         }
    }
}

    switch ($_REQUEST['action']) {
        case('novo'):
            $novo = new GerenciamentoController();
            $novo->novoFuncionario();
        break;
        case('editar'):
            $editar = new GerenciamentoController();
            $editar->editarFuncionario();
        break;
        case('deletar'):
            $deletar = new GerenciamentoController();
            $deletar->deletarFuncionario();
        break;
        default:
            header("Location: ../views/funcionario/funcionarios.php");
    }
?>
