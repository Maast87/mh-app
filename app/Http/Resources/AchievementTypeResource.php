<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AchievementTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'progress' => [
                'points' => $this->whenLoaded('progress', fn() => $this->progress->first()?->points ?? 0),
                'last_action_at' => $this->whenLoaded('progress', fn() => $this->progress->first()?->last_action_at),
            ],
            'achievements' => AchievementResource::collection($this->whenLoaded('achievements')),
        ];
    }
} 