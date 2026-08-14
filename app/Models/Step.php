<?php

declare(strict_types=1);

namespace App\Models;

use App\IdeaStatus;
use Database\Factories\StepFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[UseFactory(StepFactory::class)]
class Step extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $attributes = [
        'completed' => false,
    ];

    public function idea(): BelongsTo
    {
        return $this->belongsTo(IdeaStatus::class);
    }
}
