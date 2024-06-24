<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentMaker extends JsonResource
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
            'name'=>$this->name,
            'profile'=>$this->profile?asset('images/profiles/user-'.$this->first_name.'/'.$this->profile):'No profile',
            'gender'=>$this->gender?$this->gender!=null:'No gender',
        ];
    }
}
