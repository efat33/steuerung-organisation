<?php

namespace App\Enums;

use ReflectionClass;
use Illuminate\Validation\Rules\Enum;

final class ConversationStatus extends Enum
{
    const ANGEBOT = 'angebot';
    const ANGEBOT_WAR = 'angebot_war';
    const ABSAGE_PREIS = 'absage_preis';
    const ABSAGE_MITBEWERB = 'absage_mitbewerb';
    const ABSAGE_WIRD = 'absage_wird';
    const SONSTIGES = 'sonstiges';

    public static function cases()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public static function getLabel($value): string
    {
        return match ($value) {
            ConversationStatus::ANGEBOT => 'Angebot wird beauftragt',
            ConversationStatus::ANGEBOT_WAR => 'Angebot war nicht verständlich → nochmalige Erinnerung notwendig',
            ConversationStatus::ABSAGE_PREIS => 'Absage: Preis war zu hoch',
            ConversationStatus::ABSAGE_MITBEWERB => 'Absage: Mitbewerb hat Auftrag erhalten',
            ConversationStatus::ABSAGE_WIRD => 'Absage: Wird nicht realisiert',
            ConversationStatus::SONSTIGES => 'Sonstiges (Grund kann als Notiz angehängt werden)',
        };
    }
}



