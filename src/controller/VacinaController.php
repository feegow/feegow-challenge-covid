<?php
namespace controller;

use service\VacinaService;
use repository\VacinaRepository;
use builder\VacinaBuilder;

require_once '../service/VacinaService.php';
require_once '../repository/VacinaRepository.php';
require_once '../builder/VacinaBuilder.php';

class VacinaController
{
    public function criarVacina()
    {
        try {
            $vacinaRepository = new VacinaRepository();
            $vacinaBuilder = new VacinaBuilder();

            $vacina = $vacinaBuilder->modelBuild($_POST);
            $vacinaService = new VacinaService($vacina, $vacinaRepository);
            $vacinaService->createVacina();

            header("Location: ../views/vacina/vacinas.php?status=created");
        } catch (\Exception $e) {
            header("Location: ../views/vacina/vacinas.php?status=error");
        }
    }

    public function editarVacina(): void
    {
        try {
            $vacinaRepository = new VacinaRepository();
            $vacinaResolver = new VacinaBuilder();

            $vacina = $vacinaResolver->modelBuild($_POST);

            $vacinaService = new VacinaService($vacina, $vacinaRepository);
            $vacinaService->editVacina();

            header("Location: ../views/vacina/vacinas.php?status=edited");
        } catch (\Exception $e) {
            header("Location: ../views/vacina/vacinas.php?status=error");
        }
    }

    public function getFuncionariosVacinadosByVacina()
    {
        header("Location: ../views/vacina/funcionarios-vacinados.php?id=" . $_REQUEST['id']);
    }
}

    switch ($_REQUEST['action']) {
        case('novo'):
            $novo = new VacinaController();
            $novo->criarVacina();
        break;
        case('editar'):
            $editar = new VacinaController();
            $editar->editarVacina();
        break;
        case('funcionarios'):
            $listar = new VacinaController();
            $listar->getFuncionariosVacinadosByVacina();
        break;
        default:
            header("Location: ../views/vacina/vacinas.php");
    }
?>
