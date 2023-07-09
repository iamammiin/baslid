<?php

namespace App\Constant\User;

class UserDatabaseField
{
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const PHONE = 'phone';
    const TYPE = 'type';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const AVATAR = 'avatar';
    const COUNTRY = 'country';
    const ADDRESS = 'address';
    const LANGUAGE = 'language';
    const PRICE = 'price';
    const BIOGRAPHY = 'biography';
    const PAYPAL_ADDRESS = 'paypal_address';
    const DISCOUNT_CODE = 'discount_code';
    const DISCOUNT_PERCENT = 'discount_percent';
    const INSTAGRAM_USERNAME = 'instagram_username';
    const YOUTUBE_USERNAME = 'youtube_username';
    const TIKTOK_USERNAME = 'tiktok_username';
    const DISCOUNT_REQUEST_STATUS = 'discount_request_status';
    const DISCOUNT_REQUEST_PERCENT = 'discount_request_percent';
    const AVAILABLE_FOR_CREATE_OR_UPDATE = [
        self::FIRST_NAME,
        self::LAST_NAME,
        self::PHONE,
        self::TYPE,
        self::EMAIL,
        self::PASSWORD,
        self::AVATAR,
        self::COUNTRY,
        self::ADDRESS,
        self::LANGUAGE,
        self::PRICE,
        self::BIOGRAPHY,
        self::PAYPAL_ADDRESS,
        self::DISCOUNT_CODE,
        self::DISCOUNT_PERCENT,
        self::INSTAGRAM_USERNAME,
        self::YOUTUBE_USERNAME,
        self::TIKTOK_USERNAME,
        self::DISCOUNT_REQUEST_PERCENT,
        self::DISCOUNT_REQUEST_STATUS
    ];
}
