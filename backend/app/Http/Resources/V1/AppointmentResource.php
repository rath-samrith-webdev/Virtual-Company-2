<?php

namespace App\Http\Resources\V1;

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
            'doctor'=>DoctorDetails::make($this->doctor),
            'title'=>$this->title,
            'appointment_date'=>$this->appointment_date,
            'appointment_time'=>$this->appointment_time,
            'status'=>$this->status,
            'hospital_status'=>$this->hospital_status,
            'doctor_status'=>$this->doctor_status,
            'room'=>$this->room
        ];
    }
}
