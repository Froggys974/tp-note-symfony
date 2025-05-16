<?php
namespace App\Enum;

enum ParticipantStatusEnum: string
{
    case REGISTERED = 'registered';
    case CANCELLED = 'cancelled';
    case PRESENT = 'present';
    case ABSENT = 'absent';
}
