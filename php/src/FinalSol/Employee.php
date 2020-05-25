<?php

declare(strict_types=1);

namespace App\FinalSol;

class Employee
{
    private $name;
    /**
     * @var PayCalculator
     */
    private $pay_calculator;
    /**
     * @var HourReporter
     */
    private $hour_report;

    public function __construct(string $name, WorkHours $work_hours)
    {
        $this->name = $name;

        $this->pay_calculator = new PayCalculator($work_hours);
        $this->hour_report = new HourReporter($work_hours);
    }

    // CFO
    public function calculatePay(): int
    {
        return $this->pay_calculator->calculatePay();
    }

    // COO
    public function reportHours(): string
    {
        return $this->hour_report->reportHours();
    }

    // CTO
    public function save()
    {
        return 'saved';
    }
}
