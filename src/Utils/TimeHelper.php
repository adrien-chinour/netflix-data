<?php

namespace App\Utils;

use InvalidArgumentException;

class TimeHelper
{
    public static function toBetterUnit(int $seconds): string
    {
        $minutes = (int)($seconds / 60);
        $hours = (int)($minutes / 60);
        $days = (int)($hours / 24);

        if ($minutes <= 1) {
            $output = "$seconds seconds";
        } else if ($hours <= 1) {
            $output = "$minutes  minutes";
        } else if ($days <= 1) {
            $output = "$hours hours";
        } else {
            $output = "$days  days";
        }

        return $output;
    }

    public static function timeToSeconds(string $time): int
    {
        $explodedTime = explode(':', $time);
        if (count($explodedTime) !== 3) {
            throw new InvalidArgumentException(sprintf("Time input '%s' doesn't respect format HH:MM:SS.", $time));
        }

        return ($explodedTime[0] * 3600) + ($explodedTime[1] * 60) + $explodedTime[2];
    }

}
