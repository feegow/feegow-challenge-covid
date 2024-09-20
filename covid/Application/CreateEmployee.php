<?php

namespace Covid\Application;

use Exception;
use EmployeeService;
use Covid\Domain\Employee\DTO\EmployeeDto;
use Covid\Domain\Employee\Persistence\EmployeeRepository;

readonly class CreateEmployee
{
    private EmployeeService $service;
    public function __construct(
        private EmployeeRepository $employeeRepository
    ) {
        $this->service = new EmployeeService();
    }
    /**
     * @throws Exception
     */
    public function handle(EmployeeDto $dto): void
    {
        $employee = $this->service->buildEmployeeEntity($dto);
        $this->employeeRepository->save($employee);
    }
}
