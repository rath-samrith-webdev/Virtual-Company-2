<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
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
            'title'=>$this->title,
            'description'=>$this->description,
            'image'=>$this->image?asset('images/hospital'.$this->hospital_id.'/promotions/promotion'.$this->id.'/'.$this->image):'No image',
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date
        ];
    }
}
