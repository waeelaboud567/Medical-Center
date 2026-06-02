<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpecializationResource extends JsonResource
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
            'specialization_name' => $this->specialization_name,
            'description' => $this->description,
            'doctors_count' => $this->when(isset($this->doctors_count),$this->doctors_count),
        ];
    }
}
