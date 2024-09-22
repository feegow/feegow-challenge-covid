<?php

namespace Covid\Domain\Employee\DTO;

class EmployeeDto
{
    public int|null $id = null;

    public function __construct(
        public string $name,
        public string $cpf,
        public string $dob,
        public bool $comorbidities,
        public DosesDto  $doses,
    )
    {

    }
}
