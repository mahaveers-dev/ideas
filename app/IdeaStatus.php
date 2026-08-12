<?php

namespace App;

enum IdeaStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
        };
    }

    public static function values()
    {
        return array_map(fn($status) => $status->value, static::cases());
    }

    public function tagColors(): string
    {
        return match ($this) {
            self::PENDING => 'text-yellow-500 bg-yellow-500/10 border-yellow-500/20 hover:text-yellow-300 hover:border-yellow-300/40 data-activated:text-yellow-300 data-activated:border-yellow-300 data-activated:shadow-lg shadow-yellow-500/30 ',
            self::IN_PROGRESS => 'text-orange-500 bg-orange-500/10 border-orange-500/20 hover:text-orange-300 hover:border-orange-300/40 data-activated:text-orange-300 data-activated:border-orange-300 data-activated:shadow-lg shadow-orange-500/30 ',
            self::COMPLETED => 'text-green-500 bg-green-500/10 border-green-500/20 hover:text-green-300 hover:border-green-300/40 data-activated:text-green-300 data-activated:border-green-300 data-activated:shadow-lg shadow-green-500/30 ',
        };
    }
}
