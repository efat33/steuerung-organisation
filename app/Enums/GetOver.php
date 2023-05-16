<?php

namespace App\Enums;

use ReflectionClass;
use Illuminate\Validation\Rules\Enum;

final class GetOver extends Enum
{
    const TECHNIKER = 'techniker';
    const KTB = 'ktb';
    const KUNDE = 'kunde';
    const EINSATZLEITUNG = 'einsatzleitung';
    const BUCHHALTUNG = 'buchhaltung';
    const NEUANLAGENGESCHAFT = 'neuanlagengeschäft';
    const SONSTIGES = 'sonstiges';

    public static function cases()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public static function getLabel($value): string
    {
        return match ($value) {
            GetOver::TECHNIKER => 'Techniker',
            GetOver::KTB => 'KTB',
            GetOver::KUNDE => 'Kunde',
            GetOver::EINSATZLEITUNG => 'Einsatzleitung',
            GetOver::BUCHHALTUNG => 'Buchhaltung/Verrechnung',
            GetOver::NEUANLAGENGESCHAFT => 'Neuanlagengeschäft (Innendienst)',
            GetOver::SONSTIGES => 'Sonstiges',
        };
    }
}
