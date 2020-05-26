<?php

declare(strict_types=1);

namespace App\FinalSol;

use App\FinalSol\Days\Wednesday;

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

    /**
     * @return WorkHoursPerDay[]
     */
    private function workHours(): array
    {
        $work_hours = $this->work_hours->days();
        return array_map(function (WorkHoursPerDay $day) {
            if ($day->dayName()->equals(new Wednesday())) {
                return new WorkHoursPerDay(new Wednesday(), $day->hours() * 2, true);
            }
            return $day;
        }, $work_hours);
    }

    // CFO
    public function calculatePay(): int
    {
        return $this->regularHours() * 200 + $this->overtimeHours() * 350;
    }

    private function regularHours(): int
    {
        $total_regular_hours = 0;
        foreach ($this->workHours() as $work_hours_per_day) {
            if (! $work_hours_per_day->isWorkday()) {
                continue;
            }
            $total_regular_hours += min($work_hours_per_day->hours(), 8);
        }

        return $total_regular_hours;
    }

    private function overtimeHours(): int
    {
        $total_overtime_hours = 0;
        foreach ($this->workHours() as $work_hours_per_day) {
            if ($work_hours_per_day->isWorkday()) {
                $total_overtime_hours += max($work_hours_per_day->hours() - 8, 0);
            } else {
                $total_overtime_hours += $work_hours_per_day->hours();
            }
        }

        return $total_overtime_hours;
    }
}