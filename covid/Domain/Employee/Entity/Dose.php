<?php

namespace Covid\Domain\Employee\Entity;

use DateTime;
use DomainException;

class Dose
{
    public function __construct(
        public Medicine     $medicineApplyed,
        public Datetime     $dateApplyed,
        public DoseSequence $doseSequence,
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

    public function toArray(): array
    {
        return [
            'id' => $this->id ?? null,
            'medicine' => [
                'id' => $this->medicineApplyed->id,
                'name' => $this->medicineApplyed->name,
                'lot' => $this->medicineApplyed->lot,
                'expiration_date' => $this->medicineApplyed->expirationDate->format('Y-m-d')
            ],
            'dateApplyed' => $this->dateApplyed->format('Y-m-d'),
            'doseSequence' => $this->doseSequence->name
        ];
    }
}
