<?php

namespace Covid\Infrastructure\Persistence;

use Covid\Domain\Employee\Persistence\EmployeeDao;
use Covid\Domain\Employee\Persistence\EmployeeRepository;
use Covid\Domain\Employee\Entity\Employee;
use Covid\Domain\Employee\Entity\ValueObject\CPF;

class EmployeeRespositoryEloquent implements EmployeeRepository
{
    public function save(Employee $employee): void
    {

    }

    public function findByCpf(CPF $cpf): Employee
    {
        $employee = $this->dao->findByCpf($cpf->value());
        return new Employee(
            $employee->cpf,
            $employee->name,
            $employee->dob,
            $employee->comorbidities,
            $employee->doses
        );
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function delete(CPF $cpf): void
    {
        // TODO: Implement delete() method.
    }

    public function update(Employee $employee): void
    {
        // TODO: Implement update() method.
    }
}
