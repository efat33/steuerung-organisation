<?php

namespace App\Enums;

use ReflectionClass;
use Illuminate\Validation\Rules\Enum;

final class Package extends Enum
{
    const KOMFORT = 'komfort';
    const KOMPAKT = 'kompakt';
    const KOMFORT_HOCH_3 = 'komfort_hoch_3';
    const KOMFORT_HOCH_5 = 'komfort_hoch_5';
    const RWA_Plus = 'rwa_plus';
    const RWA_Plus_Hoch_3 = 'rwa_plus_hoch_3';
    const RWA_Plus_Hoch_5 = 'rwa_plus_hoch_5';
    const EXKLUSIV = 'exklusiv';

    public static function cases()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public static function getLabel($value): string
    {
        return match ($value) {
            Package::KOMFORT => 'Komfort',
            Package::KOMPAKT => 'Kompakt',
            Package::KOMFORT_HOCH_3 => 'Komfort Hoch 3',
            Package::KOMFORT_HOCH_5 => 'Komfort Hoch 5',
            Package::RWA_Plus => 'RWA-Plus',
            Package::RWA_Plus_Hoch_3 => 'RWA-Plus Hoch 3',
            Package::RWA_Plus_Hoch_5 => 'RWA-Plus Hoch 5',
            Package::EXKLUSIV => 'Exklusiv',    
        };
    }
}
