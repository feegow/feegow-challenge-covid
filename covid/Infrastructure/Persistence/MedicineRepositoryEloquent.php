<?php

namespace Covid\Infrastructure\Persistence;

use Covid\Domain\Employee\Entity\Medicine;
use Covid\Domain\Employee\Persistence\MedicineRepository;
use App\Models\Medicine as MedicineModel;

class MedicineRepositoryEloquent implements MedicineRepository
{

    public function save(Medicine $medicineEntity): void
    {
        MedicineModel::create([
            'name' => $medicineEntity->name,
            'lot' => $medicineEntity->lot,
            'expiration_date' => $medicineEntity->expirationDate
        ]);
    }
}
