<?php

namespace Covid\Tests;

use Covid\Domain\Employee\Entity\DoseSequence;
use Covid\Domain\Employee\Entity\Medicine;
use DateInterval;
use DateTime;
use DomainException;
use PHPUnit\Framework\TestCase;
use Covid\Domain\Employee\Entity\Doses;
use Covid\Domain\Employee\Entity\Dose;

class DosesTest extends TestCase
{
    private Medicine $medicine;

    protected function setup(): void
    {
        $expiredDate = new DateTime();
        $expiredDate->add(new DateInterval('P1M'));
        $this->medicine = new Medicine('Coronavac', '001-01', $expiredDate);
    }

    public function testApplyValidDose(): void
    {
        $doses = new Doses();
        $dose = new Dose($this->medicine, new DateTime('2022-01-01'), DoseSequence::FIRST);

        $doses->addDose($dose);

        $this->assertEquals(1, $doses->count());
    }

    public function testApplyDuplicateDose(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Dose already applied!');

        $doses = new Doses();
        $dose = new Dose($this->medicine, new DateTime('2022-01-01'), DoseSequence::FIRST);

        $doses->addDose($dose);
        $doses->addDose($dose);
    }

    public function testAddAllVacines(): void
    {
        $doses = new Doses();
        $dose1 = new Dose($this->medicine, new DateTime(), DoseSequence::FIRST);
        $dose2 = new Dose($this->medicine, new DateTime(), DoseSequence::SECOND);
        $dose3 = new Dose($this->medicine, new DateTime(), DoseSequence::THIRD);

        $doses->addDose($dose1);
        $doses->addDose($dose2);
        $doses->addDose($dose3);

        $this->assertCount(3, $doses);
    }

    public function testApplingExpiredMedicine()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Medicine expired');

        $expiredDate = new DateTime();
        $expiredDate->add(new DateInterval('P2D'));
        $medicine = new Medicine('Coronavac', '001-01', $expiredDate);
        $applyDate = clone $expiredDate;
        $applyDate->add(new DateInterval('P1D'));

        new Dose($medicine, $applyDate, DoseSequence::FIRST);
    }

    public function testApplySecondDoseWithoutFirst(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Second dose cannot be applied without first dose');

        $doses = new Doses();
        $dose = new Dose($this->medicine, new DateTime(), DoseSequence::SECOND);

        $doses->addDose($dose);
    }

    public function testApplyThirdDoseWithoutSecond(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Third dose cannot be applied without second dose');

        $doses = new Doses();
        $dose = new Dose($this->medicine, new DateTime(), DoseSequence::THIRD);

        $doses->addDose($dose);
    }

    public function TestApplyDosesInSameDay(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Dose cannot be applied on the same day as the previous dose!');

        $doses = new Doses();
        $dose1 = new Dose($this->medicine, new DateTime(), DoseSequence::FIRST);
        $dose2 = new Dose($this->medicine, new DateTime(), DoseSequence::SECOND);

        $doses->addDose($dose1);
        $doses->addDose($dose2);
    }
}
