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
            'name' => $this->name,
            'description' => $this->description,
            'priority' => $this->priority,
            'status' => new StatusResource($this->status),
            'user_id' => $this->priority,
            'children' => TaskResource::collection($this->children),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
