<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'title' => $this->title,
            'status' => $this->status,
            'description' => $this->description,
            'created_at' => now()->parse($this->created_at)->diffForHumans(),
            'completed' => $this->completed_at ? now()->parse($this->completed_at)->diffForHumans() : null

        ];
    }
}
