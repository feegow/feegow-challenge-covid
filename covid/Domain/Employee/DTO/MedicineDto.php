<?php

namespace Covid\Domain\Employee\DTO;

class MedicineDto
{
    public int $id;
    public function __construct(
        public string $name,
        public string $lot,
        public string $expirationDate,
    )
    {
    }
}
