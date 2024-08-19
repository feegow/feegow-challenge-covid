<?php

namespace enum;
class VacinaEnum
{
    const CORONAVAC = 1;
    const JANSEN = 2;
    const ASTRAZENECA = 3;
    const PFIZER = 4;

    public static function vacinasNomes(): array
    {
        return [
            'Coronavac',
            'Jansen',
            'Astrazeneca',
            'Pfizer'
        ];
    }
}

?>

