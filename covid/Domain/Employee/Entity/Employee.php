<?php

namespace Covid\Domain\Employee\Entity;

use Covid\Domain\Employee\Entity\ValueObject\CPF;
use DateTime;
use DomainException;

class Employee
{
    public function __construct(
        public CPF $cpf,
        public string $name,
        public DateTime $dob,
        public bool $portadorDeComorbidade,
        public Doses $doses,
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
}
