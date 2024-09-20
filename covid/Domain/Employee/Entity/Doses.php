<?php

namespace Covid\Domain\Employee\Entity;

use Countable;
use DomainException;

class Doses implements Countable
{
    private array $doses = [];

    public function add(Dose $dose): void
    {
        $this->validate($dose);
        $this->doses[$dose->doseNumber->value] = $dose;
    }

    private function validate(Dose $dose): void
    {
        $this->isDoseAlredyApplied($dose);
        $this->isRightSequence($dose);
        $this->isSameDayThatPreviousDose($dose);
    }

    private function isSameDayThatPreviousDose(Dose $dose): void
    {
        foreach ($this->doses as $previousDose) {
            $this->isSameDay($previousDose, $dose);
        }
    }

    private function isSameDay(Dose $previousDose, Dose $dose)
    {
        if ($previousDose->dateApplyed == $dose->dateApplyed) {
            throw new DomainException('Dose cannot be applied on the same day as the previous dose!');
        }
    }

    public function count(): int
    {
        return count($this->doses);
    }

    private function isDoseAlredyApplied(Dose $dose): void
    {
        if (isset($this->doses[$dose->doseNumber->value])) {
            throw new DomainException('Dose already applied!');
        }
    }

    private function isRightSequence(Dose $dose): void
    {
        if ($dose->doseNumber === DoseSequence::SECOND && !isset($this->doses[DoseSequence::FIRST->value])) {
            throw new DomainException('Second dose cannot be applied without first dose');
        }

        if ($dose->doseNumber === DoseSequence::THIRD && !isset($this->doses[DoseSequence::SECOND->value])) {
            throw new DomainException('Third dose cannot be applied without second dose');
        }
    }

    public function toArray(): array
    {
        return array_map(fn(Dose $dose) => $dose->toArray(), $this->doses);
    }
}
