<?php

namespace covid\Application\UseCase;

use Covid\Domain\Employee\DTO\MedicineDto;
use Covid\Domain\Employee\Entity\Medicine;
use Covid\Domain\Employee\Persistence\MedicineRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Date;

readonly class CreateMedicine
{
    public function __construct(
        private MedicineRepository $repository
    ) {
    }
    /**
     * @throws Exception
     */
    public function handle(MedicineDto $dto): void
    {
        $medicine = $this->buildMedicineEntity($dto);
        $this->repository->save($medicine);
    }

    /**
     * @throws Exception
     */
    private function buildMedicineEntity(MedicineDto $medicineDto): Medicine
    {
        return new Medicine(
            $medicineDto->name,
            $medicineDto->lot,
            new DateTime($medicineDto->expirationDate)
        );
    }
}
