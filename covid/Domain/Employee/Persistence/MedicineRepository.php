<?php

namespace Covid\Domain\Employee\Persistence;

use Covid\Domain\Employee\Entity\Medicine;

interface MedicineRepository
{
    public function save(Medicine $medicineEntity): void;
}
