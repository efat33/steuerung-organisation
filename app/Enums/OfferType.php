<?php

namespace App\Enums;

use ReflectionClass;
use Illuminate\Validation\Rules\Enum;

final class OfferType extends Enum
{
    const BAU = 'bau';
    const AUT = 'aut';

    public static function cases()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public static function getLabel($value): string
    {
        return match ($value) {
            OfferType::BAU => 'BAU',
            OfferType::AUT => 'AUT',
        };
    }
}
