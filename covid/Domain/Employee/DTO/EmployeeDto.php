<?php

namespace Covid\Domain\Employee\DTO;

class EmployeeDto
{
    public int|null $id = null;
    public string $name;
    public string $cpf;
    public string $dob;
    public string $comorbidities;
    public array  $doses;

    public function __construct(
        string $name,
        string $cpf,
        string $dob,
        string $comorbidities,
        array  $doses,
    )
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->dob = $dob;
        $this->comorbidities = $comorbidities;
        $this->doses = $doses;
    }
}
