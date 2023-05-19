<?php

namespace App\Enums;

use ReflectionClass;
use Illuminate\Validation\Rules\Enum;

final class Status extends Enum
{
    const OPEN = 'open';
    const IN_PROGRESS = 'progress';
    const OFFER_CREATED = 'offer_created';
    const TRACKING_OPEN = 'tracking_open';
    const ORDER_RECEIVED = 'order_received';
    const AGENDA_DONE = 'agenda_done';

    public static function cases()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public static function getLabel($value): string
    {
        return match ($value) {
            Status::OPEN => 'Offen',
            Status::IN_PROGRESS => 'In Bearbeitung',
            Status::OFFER_CREATED => 'Angebot wurde erstellt',
            Status::TRACKING_OPEN => 'Nachverfolgung offen',
            Status::ORDER_RECEIVED => 'Auftrag erhalten',
            Status::AGENDA_DONE => 'Agenda Erledigt',
        };
    }

    public static function getColor($value): string
    {
        return match ($value) {
            Status::OPEN => 'red',
            Status::IN_PROGRESS => 'yellow',
            Status::OFFER_CREATED => 'violet',
            Status::TRACKING_OPEN => 'orange',
            Status::ORDER_RECEIVED => 'green',
        };
    }
}
