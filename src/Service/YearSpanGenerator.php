<?php

namespace App\Service;

class YearSpanGenerator
{
    public function getYears($min, $max = 'current'): array
    {
        $years = range($min, ($max === 'current' ? date('Y') : $max));

        return array_combine($years, $years);
    }
}
