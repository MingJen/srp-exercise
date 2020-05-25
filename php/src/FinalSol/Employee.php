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

    public function __construct(string $name, array $work_hours_array)
    {
        $this->name = $name;
        $this->work_hours_array = $work_hours_array;

        $this->pay_calculator = new PayCalculator($work_hours_array);
    }

    // CFO
    public function calculatePay(): int
    {
        return $this->pay_calculator->calculatePay();
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
}
