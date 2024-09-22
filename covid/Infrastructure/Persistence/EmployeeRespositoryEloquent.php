<?php

namespace Covid\Infrastructure\Persistence;

use App\Models\Dose;
use Covid\Domain\Employee\Entity\Doses;
use Covid\Domain\Employee\Persistence\EmployeeRepository;
use Covid\Domain\Employee\Entity\Employee;
use Covid\Domain\Employee\Entity\ValueObject\CPF;
use App\Models\Employee as EmployeeModel;

class EmployeeRespositoryEloquent implements EmployeeRepository
{
    public function save(Employee $employeeEntity): void
    {
        $employeeModel = EmployeeModel::create([
            'cpf' => $employeeEntity->cpf->value(),
            'name' => $employeeEntity->name,
            'dob' => $employeeEntity->dob,
            'comorbidities' => $employeeEntity->comorbidities
        ]);

        $doses = $this->prepareDosesToCreate($employeeEntity->doses, $employeeEntity->cpf->value());
        $employeeModel->doses()->createMany($doses);
    }

    public function findByCpf(CPF $cpf): Employee
    {
        //
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function delete(CPF $cpf): void
    {
        // TODO: Implement delete() method.
    }

    public function update(Employee $employeeEntity): void
    {
        $employeeModel = EmployeeModel::find($employeeEntity->cpf);
        $employeeModel->update([
            'name' => $employeeEntity->name,
            'dob' => $employeeEntity->dob,
            'comorbidities' => $employeeEntity->comorbidities
        ]);
        $doses = $this->prepareDosesToUpdate($employeeEntity->doses, $employeeEntity->cpf);
        foreach ($doses as $dose) {
            Dose::createOrFirst($dose[0], $dose[1]);
        }
    }

    private function prepareDosesToCreate(Doses $dosesEntity, string $cpf): array
    {
        return array_map(function ($dose) use ($cpf) {
            return [
                'medicine_id' => $dose['medicine']['id'],
                'date_applyed' => $dose['dateApplyed'],
                'dose_sequence' => $dose['doseSequence'],
                'employee_cpf' => $cpf
            ];
        }, $dosesEntity->toArray());
    }

    private function prepareDosesToUpdate(Doses $dosesEntity, string $cpf): array
    {
        return array_map(function ($dose) use ($cpf) {
            return [
                [
                    'employee_cpf' => $cpf,
                    'dose_sequence' => $dose['doseSequence']
                ],
                [
                    'medicine_id' => $dose['medicine']['id'],
                    'date_applyed' => $dose['dateApplyed']
                ]
            ];
        }, $dosesEntity->toArray());
    }
}
