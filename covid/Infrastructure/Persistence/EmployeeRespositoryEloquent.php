<?php

namespace Covid\Infrastructure\Persistence;

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
        //if (count($doses) > 0) {
        $employeeModel->doses()->createMany($doses);
        //}
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
        $employeeModel = EmployeeModel::find($employeeEntity->id);
        $employeeModel->update([
            'cpf' => $employeeEntity->cpf->value(),
            'name' => $employeeEntity->name,
            'dob' => $employeeEntity->dob,
            'comorbidities' => $employeeEntity->comorbidities
        ]);

        $doses = $this->getNewDoses($employeeEntity->doses, $employeeModel->cpf);

        Doses::createMany($doses);
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

    private function getNewDoses($doses, string $cpf): array
    {
        $dosesFiltered = $doses->filter(function ($dose) {
            return $dose->id === null;
        });

        return $this->prepareDosesToCreate($dosesFiltered, $cpf);
    }
}
