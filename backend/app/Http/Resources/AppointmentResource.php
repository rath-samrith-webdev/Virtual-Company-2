<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'hospital'=>$this->hospital->name,
            'user'=>AppointmentMaker::make($this->user),
            'appointment_date'=>$this->appointment_date
        ];
    }
}
