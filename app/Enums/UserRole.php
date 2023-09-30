<?php

namespace App\Enums;

use ReflectionClass;
use Illuminate\Validation\Rules\Enum;

final class UserRole extends Enum
{
    const ADMIN = 'admin';
    const TECHNICIAN = 'technician';
    const WORKER = 'worker';

    public static function cases()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public static function getLabel($value): string
    {
        return match ($value) {
            UserRole::ADMIN => 'Admin',
            UserRole::TECHNICIAN => 'Interner Beobachter',
            UserRole::WORKER => 'Innendienstmitarbeiter',
        };
    }
}
