<?php

declare(strict_types=1);

namespace App\FinalSol;

use App\FinalSol\Days\Friday;
use App\FinalSol\Days\Monday;
use App\FinalSol\Days\Saturday;
use App\FinalSol\Days\Sunday;
use App\FinalSol\Days\Thursday;
use App\FinalSol\Days\Tuesday;
use App\FinalSol\Days\Wednesday;

class WorkHoursPerDay
{
    /**
     * @var DayName
     */
    private $day_name;
    /**
     * @var int
     */
    private $hours;
    /**
     * @var bool
     */
    private $is_workday;

    public function __construct(DayName $day_name, int $hours, bool $is_workday)
    {
        $this->day_name = $day_name;
        $this->hours = $hours;
        $this->is_workday = $is_workday;
    }

    public function dayName(): DayName
    {
        return $this->day_name;
    }

    public function hours(): int
    {
        return $this->hours;
    }

    public static function create(int $week_number, int $hours)
    {
        $is_workday = true;
        switch ($week_number)
        {
            case 0:
                $day = new Sunday();
                $is_workday = false;
                break;
            case 1:
                $day = new Monday();
                break;
            case 2:
                $day = new Tuesday();
                break;
            case 3:
                $day = new Wednesday();
                break;
            case 4:
                $day = new Thursday();
                break;
            case 5:
                $day = new Friday();
                break;
            case 6:
                $day = new Saturday();
                $is_workday = false;
                break;
            default:
                throw new \Exception('找不到對應的名稱');
        }

        return new static($day, $hours, $is_workday);
    }

    public function isWorkday(): bool
    {
        return $this->is_workday;
    }
}