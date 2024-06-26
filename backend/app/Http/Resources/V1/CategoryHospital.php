<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryHospital extends JsonResource
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
            'cover_image'=>asset('/images/hospital/hospital-cover/hospital-'.$this->id.'/'.$this->cover_image),
            'name'=>$this->name,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude
        ];
    }
}
