<?php

declare(strict_types=1);

namespace App\FinalSol;

use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * @var Employee
     */
    private $employee;

    protected function setUp()
    {
        $work_hours_array = [
            4, // 日
            9, // 一
            8, // 二
            5, // 三
            9, // 四
            9, // 五
            7, // 六
        ];
        $this->employee = new Employee('Bob', new WorkHours($work_hours_array));
    }

    public function testHaveWorkHours()
    {
        $this->expectExceptionMessage('應該要有一週的工時資料');

        new Employee('Bob', new WorkHours([8]));
    }

    public function testWorkHoursFormat()
    {
        $this->expectExceptionMessage('工時資料應該為數字');

        new Employee('Bob', new WorkHours([8, 9, 9, 10, 2, 3, 'a']));
    }

    public function testWorkHoursRange()
    {
        $this->expectExceptionMessage('工時資料應該為 0 - 16 的數字');

        new Employee('Bob', new WorkHours([8, 9, 9, 10, 2, 3, 19]));
    }

    public function testReportHours()
    {
        $this->assertEquals('Regular Hours: 37', $this->employee->reportHours());
    }

    public function testCalculatePay()
    {
        $this->assertEquals(13600, $this->employee->calculatePay());
    }
}
