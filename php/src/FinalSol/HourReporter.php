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
        return sprintf('Regular Hours: %s', $this->work_hours->regularHours());
    }
}
