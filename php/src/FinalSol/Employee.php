<?php

declare(strict_types=1);

namespace App\FinalSol;

class Employee
{
    /**
     * @var int[]
     */
    private $work_hours_array;
    private $name;
    /**
     * @var PayCalculator
     */
    private $pay_calculator;
    /**
     * @var HourReporter
     */
    private $hour_report;

    public function __construct(string $name, array $work_hours_array)
    {
        $this->name = $name;
        $this->work_hours_array = $work_hours_array;

        $this->pay_calculator = new PayCalculator($work_hours_array);
        $this->hour_report = new HourReporter($work_hours_array);
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
