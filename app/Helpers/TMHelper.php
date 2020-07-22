<?php

namespace App\Helpers;

use \Illuminate\Database\Eloquent\Collection;

class TMHelper
{
    /**
     * @param float $time
     * @return string
     */
    public function formateTime(float $time): string
    {
        $fullTimeSep = explode('.', $time);

        if (!empty($fullTimeSep[1])) {
            $hours = $fullTimeSep[0];
            $minutes = floor(($fullTimeSep[1] * 60) / 10);
            $minutes = strlen($minutes) == 1 ? $minutes * 10 : $minutes;
            $time = "{$hours} ч. {$minutes} м.";
        } else {
            $time = "{$fullTimeSep[0]} ч.";
        }

        return $time != 0 ? $time : '';
    }

    /**
     * @param Collection $collection
     * @return array
     */
    public function sumTimeAndEstimate($builder): array
    {
        $sumTime = 0;
        $sumEstimate = 0;

        $builder->each(function ($issue) use (&$sumTime, &$sumEstimate) {
            $sumTime += $issue->times->sum('time') * $issue->project->source->price;
            $sumEstimate += $issue->estimate * $issue->project->source->price;
        });

        return compact(['sumTime', 'sumEstimate']);
    }

    /**
     * @param Collection $statisticData
     * @return array
     */
    public function prepareStatisticData($statisticData): array
    {
        $sumTime = [];
        $sumEstimate = [];
        for ($i = 1; $i <= 12; $i++) {
            if (empty($statisticData[$i])) {
                $sumTime[$i] = '';
                $sumEstimate[$i] = '';
            } else {
                $sumData = static::sumTimeAndEstimate($statisticData[$i]);
                $sumTime[$i] = $sumData['sumTime'];
                $sumEstimate[$i] = $sumData['sumEstimate'];
            }
        }
        $sumTime = implode(',', $sumTime);
        $sumEstimate = implode(',', $sumEstimate);

        return compact(['sumTime', 'sumEstimate']);
    }
}