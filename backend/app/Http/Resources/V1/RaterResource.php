<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaterResource extends JsonResource
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
            'full_name'=>$this->first_name.' '.$this->last_name,
            'profile'=>$this->profile?asset('images/profiles/user-'.$this->first_name.'/'.$this->profile):'No profile',
        ];
    }
}
