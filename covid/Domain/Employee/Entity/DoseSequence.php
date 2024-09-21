<?php

namespace Covid\Domain\Employee\Entity;

enum DoseSequence: string
{
    case FIRST = 'first';
    case SECOND = 'second';
    case THIRD = 'third';
}
