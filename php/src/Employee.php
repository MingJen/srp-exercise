<?php

declare(strict_types=1);

namespace App;

use Assert\Assertion;

class Employee
{
    /**
     * @var int[]
     */
    private $work_hours_array;
    private $name;

    public function __construct(string $name, array $work_hours_array)
    {
        Assertion::count($work_hours_array, 7, '應該要有一週的工時資料');
        Assertion::allInteger($work_hours_array, '工時資料應該為數字');
        Assertion::allRange($work_hours_array, 0, 16, '工時資料應該為 0 - 16 的數字');
        $this->name = $name;
        $this->work_hours_array = $work_hours_array;
    }

    // CFO
    public function calculatePay(): int
    {
        return $this->regularHours() * 200 + $this->overtimeHours() * 350;
    }

    // COO
    public function reportHours(): string
    {
        return sprintf('Regular Hours: %s', $this->regularHours());
    }

    // CTO
    public function save()
    {
        return 'saved';
    }

    private function regularHours(): int
    {
        $total_regular_hours = 0;
        foreach ($this->work_hours_array as $index => $work_hours_per_day) {
            if ($index === 0 || $index === 6) {
                continue;
            }
            $total_regular_hours += min($work_hours_per_day, 8);
        }

        return $total_regular_hours;
    }

    private function overtimeHours(): int
    {
        $workdays_index = range(1, 5);
        $total_overtime_hours = 0;
        foreach ($this->work_hours_array as $index => $work_hours_per_day) {
            $is_workday = in_array($index, $workdays_index);
            if ($is_workday) {
                $total_overtime_hours += max($work_hours_per_day - 8, 0);
            } else {
                $total_overtime_hours += $work_hours_per_day;
            }
        }

        return $total_overtime_hours;
    }
}
