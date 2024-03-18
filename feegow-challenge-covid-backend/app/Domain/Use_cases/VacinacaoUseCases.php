<?php

namespace App\Domain\Use_cases;

use Exception;

class VacinacaoUseCases
{
    public function updateDose($doseAtual, $novaDose, $dataAtual, $novaData)
    {
        // Verifica se a nova dose é maior que a dose atual + 1
        if ($novaDose > $doseAtual + 1) {
            throw new Exception("Falta uma dose antes para ser cadastrada");
        }

        // Verifica se a nova dose é menor que 1
        if ($novaDose < 1) {
            throw new Exception("A dose é inválida");
        }
        
        // Verifica se a data da nova dose é maior que a data da dose atual
        if ($novaData <= $dataAtual) {
            throw new Exception("A data da nova dose deve ser maior que a data da dose atual");
        }

        return true;
    }
}

