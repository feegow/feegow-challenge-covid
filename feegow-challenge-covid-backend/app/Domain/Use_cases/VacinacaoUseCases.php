<?php

namespace App\Domain\Use_cases;

use Exception;

class VacinacaoUseCases
{
    public function updateDose($doseAtual, $novaDose)
    {
        // Verifica se a nova dose é maior que a dose atual + 1
        if ($novaDose > $doseAtual + 1) {
            throw new Exception("Falta uma dose antes para ser cadastrada");
        }

        // Verifica se a nova dose é menor que 1
        if ($novaDose < 1) {
            throw new Exception("A dose é inválida");
        }

        return true;
    }
}
