<?php

namespace Covid\Domain\Employee\Entity;

use DateTime;
use DomainException;

class Dose
{
    public readonly int|null $id;
    public function __construct(
        public Medicine     $medicineApplyed,
        public Datetime     $dateApplyed,
        public DoseSequence $doseNumber,
    )
    {
        $this->validate();
    }

    public function addId(int|null $id): void
    {
        $this->id = $id;
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
            'id' => $this->id,
            'medicine' => [
                'id' => $this->medicineApplyed->id,
                'name' => $this->medicineApplyed->name,
                'lot' => $this->medicineApplyed->lot,
                'expiration_date' => $this->medicineApplyed->expirationDate->format('Y-m-d')
            ],
            'dateApplyed' => $this->dateApplyed->format('Y-m-d'),
            'doseNumber' => $this->doseNumber->name
        ];
    }
}
