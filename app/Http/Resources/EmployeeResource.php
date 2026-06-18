<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'employee_id' => $this->id,
            'hire_date' => $this->hire_date,
            'salary' => $this->salary,
            'employment_status' => $this->employment_status,
            'user_info' => new UserResource($this->whenLoaded('person.user'))

        ];
    }
}
