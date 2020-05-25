<?php

declare(strict_types=1);

namespace App\FinalSol;

class PayCalculator
{
    /**
     * @var WorkHours
     */
    private $work_hours;

    public function __construct(WorkHours $work_hours)
    {
        $this->work_hours = $work_hours;
    }

    private function workHours(): array
    {
        $work_hours = $this->work_hours->workHoursArray();
        $work_hours[3] = $work_hours[3] * 2;

        return $work_hours;
    }

    // CFO
    public function calculatePay(): int
    {
        return $this->regularHours() * 200 + $this->overtimeHours() * 350;
    }

    private function regularHours(): int
    {
        $total_regular_hours = 0;
        foreach ($this->workHours() as $index => $work_hours_per_day) {
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
        foreach ($this->workHours() as $index => $work_hours_per_day) {
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