<?php

namespace Covid\Tests;

use Covid\Domain\Employee\Entity\Dose;
use Covid\Domain\Employee\Entity\DoseSequence;
use Covid\Domain\Employee\Entity\Medicine;
use DateTime;
use DomainException;
use PHPUnit\Framework\TestCase;
use Covid\Domain\Employee\Entity\Employee;
use Covid\Domain\Employee\Entity\ValueObject\CPF;
use Covid\Domain\Employee\Entity\Doses;

class EmployeeTest extends TestCase
{
    public function testConstructorWithValidDataDoesNotThrowException(): void
    {
        $cpf = new CPF('173.741.710-30');
        $name = 'John Doe';
        $dob = new DateTime('2000-01-01');
        $comorbidities = false;
        $doses = new Doses();
        $vacina = new Medicine('Coronavac', '001-01', new DateTime('2025-01-01'));
        $dose = new Dose($vacina, new DateTime('2021-01-01'), DoseSequence::FIRST);
        $doses->add($dose);

        $funcionario = new Employee($cpf, $name, $dob, $comorbidities, $doses);

        $this->assertEquals($cpf, $funcionario->cpf);
        $this->assertEquals($name, $funcionario->name);
        $this->assertEquals($dob, $funcionario->dob);
        $this->assertEquals($comorbidities, $funcionario->comorbidities);
        $this->assertEquals($doses, $funcionario->doses);
    }

    public function testConstructorWithEmptyNameThrowsException(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Name cannot be empty');

        new Employee(new CPF('173.741.710-30'), '', new DateTime('2000-01-01'), false, new Doses(2));
    }

    public function testConstructorWithFutureDobThrowsException(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Date of birth cannot be in the future');

        new Employee(new CPF('173.741.710-30'), 'John Doe', new DateTime('3000-01-01'), false, new Doses(2));
    }

    public function testConstructorWithCpfInvalid(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Invalid CPF');

        new Employee(new CPF('123.456.789-01'), 'John Doe', new DateTime('2000-01-01'), false, new Doses(2));
    }
}
