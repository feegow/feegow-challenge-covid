<?php

namespace service;

use model\Vacina;
use repository\VacinaRepository;

require_once "Database.php";

class VacinaService
{
    private $vacina;

    private $vacinaRepository;

    public function __construct(?Vacina $vacina, VacinaRepository $vacinaRepository)
    {
        $this->vacina = $vacina;
        $this->vacinaRepository = $vacinaRepository;
    }

    public function getVacinas()
    {
        return $this->vacinaRepository->findAll();
    }

    public function createVacina()
    {
        $this->vacinaRepository->create($this->vacina);
    }

    public function editVacina()
    {
        return $this->vacinaRepository->update($this->vacina);
    }

    public function showVacina($id)
    {
        return $this->vacinaRepository->findById($id);
    }

    public function getFuncionariosVacinadosByVacina($id): bool|array
    {
        return $this->vacinaRepository->findFuncionariosByVacina($id);
    }
}
