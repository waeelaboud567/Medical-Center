<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
        'department_name' => $this->department_name,
        'location' => $this->location,

        'doctors_count' => $this->whenCounted('doctors'),
        'nurses_count' => $this->whenCounted('nurses'),
    ];
    }
}
