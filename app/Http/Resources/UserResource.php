<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_name' => $this->user_name,
            'email' => $this->email,
            'status' => $this->status,
            'role' => $this->getRoleNames()->first(),

            'person' => [
                'id' => $this->person?->id,
                'first_name' => $this->person?->first_name,
                'last_name' => $this->person?->last_name,

                'full_name' =>
                    $this->person?->first_name . ' ' .
                    $this->person?->last_name,

                'phone' => $this->person?->phone,

                'gender' => $this->person?->gender,

                'address' => $this->person?->address,

                'date_of_birth' => $this->person?->date_of_birth,
            ],
          ];

    }
}
