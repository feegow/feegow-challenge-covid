<?php

namespace covid\Application\UseCase;

use Covid\Domain\Employee\EmployeeService;
use Exception;
use Covid\Domain\Employee\DTO\EmployeeDto;
use Covid\Domain\Employee\Persistence\EmployeeRepository;

readonly class UpdateEmployee
{
    private EmployeeService $service;
    public function __construct(
        private EmployeeRepository $repository
    ) {
        $this->service = new EmployeeService();
    }
    /**
     * @throws Exception
     */
    public function handle(EmployeeDto $dto): void
    {
        $employee = $this->service->buildEmployeeEntity($dto);
        $this->repository->update($employee);
    }
}
