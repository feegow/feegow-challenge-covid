<?php

namespace Covid\Domain\Employee\Entity;
use DateTime;
use DomainException;

class Medicine
{
    public readonly int|null $id;
    public function __construct(
        public string $name,
        public string $lot,
        public DateTime $expirationDate,
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
        if ($this->name === '') {
            throw new DomainException('Name cannot be empty');
        }

        if ($this->lot === '') {
            throw new DomainException('Lot cannot be empty');
        }

        if ($this->expirationDate->diff(new DateTime())->invert !== 1) {
            throw new DomainException('Expiration date must be in the future');
        }
    }
}
