<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AchievementResource extends JsonResource
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
            'description' => $this->description,
            'required_points' => $this->required_points,
            'tier_name' => $this->tier_name,
            'icon_path' => $this->icon_path,
            'is_earned' => $this->whenLoaded('users', fn() => $this->users->isNotEmpty()),
            'can_be_earned' => $this->when(isset($this->can_be_earned), fn() => $this->can_be_earned),
            'earned_at' => $this->whenLoaded('users', fn() => $this->users->first()?->pivot->earned_at),
        ];
    }
} 