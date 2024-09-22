<?php

namespace Covid\Domain\Employee\DTO;

use Iterator;

class DosesDto
{
    public function __construct(
        public DoseDto|null $firstDose,
        public DoseDto|null $secondDose,
        public DoseDto|null $thirdDose,
    )
    {

    }
}
