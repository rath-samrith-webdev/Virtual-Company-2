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
            'cover_image'=>$this->cover_image?asset('/images/hospital'.$this->id.'/hospital-cover/hospital-'.$this->id.'/'.$this->cover_image):'No Cover',
            'preview_images'=>PreviewImagesResource::collection($this->previewImage()->get()),
            'department'=>DepartmentResource::collection($this->departments()->get()),
            'appointment'=>AppointmentResource::collection($this->appointments()->get()),
            'feedbacks'=>RateResource::collection($this->rates()->latest()->get()),
            'open_time'=>$this->open_time?$this->open_time:'Not set yet',
            'close_time'=>$this->close_time?$this->close_time:'Not set yet',
            'street'=>$this->street?$this->street:'Not Added yet',
            'village'=>$this->village?$this->village:'Not Added yet',
            'commune'=>$this->commune?$this->commune:'Not Added yet',
            'district'=>$this->district?$this->district:'Not Added yet',
            'province'=>$this->province?$this->province:'Not Added yet',
            'lat'=>$this->latitude,
            'lng'=>$this->longitude,
            'category'=>$this->category,
            'doctors'=>DoctorDetails::collection($this->doctors()->get()),
            'favourite_by'=>$this->favourites()->get()->count(),
            'average_rating'=>$this->rates()->sum('star')>0?round($this->rates()->sum('star')/$this->rates()->count()):'0',
            'rooms'=>$this->rooms()->get(),
            'phone_number'=>$this->phone_number,
            'vision'=>$this->vision?$this->vision:'Not set yet',
            'mission'=>$this->mission?$this->mission:'Not set yet',
        ];
    }
}
