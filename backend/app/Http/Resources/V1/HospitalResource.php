<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HospitalResource extends JsonResource
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
            'cover_image'=>asset('/images/hospital/hospital-cover/hospital-'.$this->id.'/'.$this->cover_image),
            'preview_images'=>PreviewImagesResource::collection($this->previewImage()->get()),
            'department'=>$this->departments()->get(),
            'appointment'=>AppointmentResource::collection($this->appointments()->get()),
            'street'=>$this->street?$this->street:'Not Added yet',
            'village'=>$this->village?$this->village:'Not Added yet',
            'commune'=>$this->commune?$this->commune:'Not Added yet',
            'district'=>$this->district?$this->district:'Not Added yet',
            'province'=>$this->province?$this->province:'Not Added yet',
            'lat'=>$this->latitude,
            'lng'=>$this->longitude,
            'feedbacks'=>RateResource::collection($this->rates()->latest()->get()),
            'doctors'=>$this->doctors()->get()
        ];
    }
}
