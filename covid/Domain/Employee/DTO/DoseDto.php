<?php

namespace Covid\Domain\Employee\DTO;

use Covid\Domain\Employee\Entity\DoseSequence;

class DoseDto
{
    public function __construct(
        public MedicineDto  $medicine,
        public string       $dateApplyed,
        public DoseSequence $doseSequence,
    )
    {
    }
}
