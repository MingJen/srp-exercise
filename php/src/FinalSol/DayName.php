<?php

declare(strict_types=1);

namespace App\FinalSol;

abstract class DayName
{
    abstract public function key(): int;

    public function equals(DayName $day_name): bool
    {
        return $this->key() === $day_name->key();
    }
}
