<?php

declare(strict_types=1);

namespace App\FinalSol;

class HourReporter
{
    /**
     * @var WorkHours
     */
    private $work_hours;

    public function __construct(WorkHours $work_hours)
    {
        $this->work_hours = $work_hours;
    }

    public function reportHours(): string
    {
        return sprintf('Regular Hours: %s', $this->regularHours());
    }

    private function regularHours(): int
    {
        $total_regular_hours = 0;
        foreach ($this->work_hours->workHoursArray() as $index => $work_hours_per_day) {
            if ($index === 0 || $index === 6) {
                continue;
            }
            $total_regular_hours += min($work_hours_per_day, 8);
        }

        return $total_regular_hours;
    }
}
