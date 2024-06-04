<?php

namespace App\Consts;

class VisitTypeConst
{
    public const DAY_TRIP = 'day_trip';
    public const OVERNIGHT = 'overnight';
    public const VISIT_TYPE_JA = [
        self::DAY_TRIP => '日帰り',
        self::OVERNIGHT => '宿泊',
    ];
}
