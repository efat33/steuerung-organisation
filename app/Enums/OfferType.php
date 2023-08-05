<?php

namespace App\Enums;

use ReflectionClass;
use Illuminate\Validation\Rules\Enum;

final class OfferType extends Enum
{
    const AUT = 'aut';
    const BAU = 'bau';

    public static function cases()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public static function getLabel($value): string
    {
        return match ($value) {
            OfferType::AUT => 'AUT',
            OfferType::BAU => 'BAU',
        };
    }
}