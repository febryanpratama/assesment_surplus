<?php

namespace App\Helpers;

class Format
{
    public static function OvertimesPay($expression, $salary, $overtimes)
    {
        $str = $expression;

        $salary = str_replace('salary', $salary, $str);
        $overtime = str_replace('overtime_duration_total', $overtimes, $salary);

        return eval('return ' . $overtime . ';');
    }

    public static function duration($start, $end)
    {
        // 
        // $start = 
        $start = strtotime($start);
        $end = strtotime($end);

        $diff = $end - $start;
        // dd($diff);
        $x = $diff / 60;
        return round($x / 60);
    }
}
