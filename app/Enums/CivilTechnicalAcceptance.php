<?php

namespace App\Enums;

use ReflectionClass;
use Illuminate\Validation\Rules\Enum;

final class CivilTechnicalAcceptance extends Enum
{
    const KEINE = 'keine_abnahme_erforderlich';
    const ZIVILTECHNIKER_MUSS = 'ziviltechniker_muss_bestellt_werden';
    const ZIVILTECHNIKER_WURDE = 'ziviltechniker_wurde_bestellt';
    const ABNAHMEGUTACHTEN = 'abnahmegutachten_erhalten';

    public static function cases()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public static function getLabel($value): string
    {
        return match ($value) {
            CivilTechnicalAcceptance::KEINE => 'Keine Abnahme erforderlich',
            CivilTechnicalAcceptance::ZIVILTECHNIKER_MUSS => 'Ziviltechniker muss bestellt werden',
            CivilTechnicalAcceptance::ZIVILTECHNIKER_WURDE => 'Ziviltechniker wurde bestellt',
            CivilTechnicalAcceptance::ABNAHMEGUTACHTEN => 'Abnahmegutachten erhalten',
        };
    }
}
