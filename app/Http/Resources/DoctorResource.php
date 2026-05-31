<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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

            'specialization'=>$this->specialization?->specialization_name,

            'license_number' => $this->license_number,

            'employee'=> new EmployeeResource($this->whenLoaded('employee')),

            'user'=>new UserResource($this->employee->person->user)
        ];
    }
}
