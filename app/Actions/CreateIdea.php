<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;

class CreateIdea
{
    public function __construct(#[CurrentUser] protected User $user)
    {
        //
    }
    
    public function handle(array $attributes)
    {

        $data = collect($attributes)->only([
            'title',
            'description',
            'status',
            'links',
        ])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        # $steps = collect($attributes['steps'] ?? [])->map(fn($step) => ['description' => $step]);

        DB::transaction(function () use ($data, $attributes) {
            $idea = $this->user->ideas()->create($data);
            $idea->steps()->createMany($attributes['steps'] ?? []);
        });

    }
}