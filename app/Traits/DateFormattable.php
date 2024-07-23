<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateFormattable
{

    public function getFormattedDate($column, string $format = 'F j, Y')
    {
        return Carbon::parse($this->$column)->format($format);
    }

    public function getAutoDiffTime(
        $column,
        int $difference = 24,
        string $format = 'F j, Y',
    ) {
        $created_at = Carbon::create($column);
        $now = Carbon::now();
        $hours_diff = $created_at->diffInHours($now);
        $readable = $created_at->diffForHumans($now);

        return ($hours_diff > $difference) ? $this->getFormattedDate($column, $format) : $readable;
    }
}
