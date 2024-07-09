<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorDetails extends JsonResource
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
            'uid'=>$this->user->id,
            'first_name'=>$this->user->first_name,
            'name'=>$this->user->name,
            'profile'=>$this->user->profile?asset('images/profiles/user-'.$this->first_name.'/'.$this->user->profile):'No profile',
            'last_name'=>$this->user->last_name,
            'email'=>$this->user->email,
            'hospital_id'=>$this->hospital_id,
            'phone'=>$this->phone_number?$this->phone_number:'No contact'
        ];
    }
}
