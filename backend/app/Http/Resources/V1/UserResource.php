<?php

namespace App\Http\Resources\V1;

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
            'id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'name'=>$this->name,
            'gender'=> $this->gender?$this->gender:'No gender',
            'date_of_birth'=>$this->date_of_birth?$this->date_of_birth!=null:'No date of birth',
            'profile'=>$this->profile?asset('images/profiles/user-'.$this->first_name.'/'.$this->profile):'No profile',
            'email'=>$this->email,
            'appointments'=>AppointmentResource::collection($this->appointments()->latest()->get()),
        ];
    }
}
