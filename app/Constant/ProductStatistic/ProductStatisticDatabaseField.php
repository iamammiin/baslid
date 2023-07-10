<?php

namespace App\Constant\ProductStatistic;

class ProductStatisticDatabaseField
{
    const USER_ID = 'user_id';
    const NAME = 'name';
    const IMAGE = 'image';
    const DATE = 'date';
    const TENDERED = 'tendered';
    const EARNING = 'earning';
    const STATUS = 'status';
    const STRIP_ID = 'strip_id';

    const AVAILABLE_FOR_CREATE_OR_UPDATE = [
        self::USER_ID,
        self::NAME,
        self::IMAGE,
        self::DATE,
        self::TENDERED,
        self::EARNING,
        self::STATUS,
        self::STRIP_ID
    ];
}
