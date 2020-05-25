<?php

declare(strict_types=1);

namespace App\FinalSol;

use Assert\Assertion;

class WorkHours
{
    /**
     * @var array
     */
    private $work_hours_array;

    public function __construct(array $work_hours_array)
    {
        Assertion::count($work_hours_array, 7, '應該要有一週的工時資料');
        Assertion::allInteger($work_hours_array, '工時資料應該為數字');
        Assertion::allRange($work_hours_array, 0, 16, '工時資料應該為 0 - 16 的數字');
        $this->work_hours_array = $work_hours_array;
    }

    public function workHoursArray(): array
    {
        return $this->work_hours_array;
    }
}