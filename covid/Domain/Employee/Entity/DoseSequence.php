<?php

namespace Covid\Domain\Employee\Entity;

enum DoseSequence: int
{
    case FIRST = 1;
    case SECOND = 2;
    case THIRD = 3;
}
