<?php

namespace Covid\Tests;

use DateTime;
use DomainException;
use PHPUnit\Framework\TestCase;
use Covid\Domain\Employee\Entity\Dose;
use Covid\Domain\Employee\Entity\Medicine;
use Covid\Domain\Employee\Entity\DoseSequence;

class DoseTest extends TestCase
{
    public function constructorWithValidDataDoesNotThrowException(): void
    {
        $medicine = new Medicine('Pfiser', '123-4', new DateTime('2024-01-01'));
        $dateApplied = new DateTime('2022-01-01');

        $dose = new Dose($medicine, $dateApplied, DoseSequence::FIRST);

        $this->assertEquals($medicine, $dose->medicineApplyed);
        $this->assertEquals($dateApplied, $dose->dateApplyed);
        $this->assertEquals(DoseSequence::FIRST, $dose->doseSequence);
    }

    public function constructorWithExpiredMedicineThrowsException(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Medicine expired');

        $medicine = new Medicine('Pfiser', '123-4', new DateTime('2024-01-01'));
        new Dose($medicine, new DateTime('2024-01-02'), DoseSequence::FIRST);
    }
}
