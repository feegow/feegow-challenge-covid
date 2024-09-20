<?php

namespace Covid\Domain\Employee\Entity;

use Covid\Domain\Employee\Entity\ValueObject\CPF;
use DateTime;
use DomainException;

class Employee
{
    public int|null $id;
    public function __construct(
        public CPF      $cpf,
        public string   $name,
        public DateTime $dob,
        public bool     $comorbidities,
        public Doses    $doses,
    )
    {
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->name === '') {
            throw new DomainException('Name cannot be empty');
        }

        if ($this->dob->diff(new DateTime())->invert === 1) {
            throw new DomainException('Date of birth cannot be in the future');
        }

        if (!$this->dob instanceof DateTime) {
            throw new DomainException('Date of birth cannot be in the future');
        }
    }

    public function addId(int|null $id): void
    {
        $this->id = $id;
    }

    public function toArray():array
    {
        return [
            'id' => $this->id,
            'cpf' => $this->cpf->value(),
            'name' => $this->name,
            'dob' => $this->dob->format('Y-m-d'),
            'comorbidities' => $this->comorbidities,
            'doses' => $this->doses->toArray()
        ];
    }
}
