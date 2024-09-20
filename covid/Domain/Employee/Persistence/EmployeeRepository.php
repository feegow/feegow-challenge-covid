<?php

namespace Covid\Domain\Employee\Persistence;

use Covid\Domain\Employee\Entity\Employee;
use Covid\Domain\Employee\Entity\ValueObject\CPF;

interface EmployeeRepository
{
    public function save(Employee $employee): void;
    public function findByCpf(CPF $cpf): Employee;
    public function findAll(): array;
    public function delete(CPF $cpf): void;
    public function update(Employee $employee): void;
}
