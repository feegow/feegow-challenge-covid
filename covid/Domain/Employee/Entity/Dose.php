<?php

namespace Covid\Domain\Employee\Entity;

use DateTime;
use DomainException;

class Dose
{
    public function __construct(
        public Medicine     $medicineApplyed,
        public Datetime     $dateApplyed,
        public DoseSequence $doseNumber,
    )
    {
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->dateApplyed->diff($this->medicineApplyed->expirationDate)->invert === 1) {
            throw new DomainException('Medicine expired');
        }
    }
}
