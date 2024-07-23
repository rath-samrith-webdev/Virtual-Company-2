<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'details' => $this->details,
            'image' => $this->image ? asset('images/hospital'.$this->hospital_id.'/departments/department'.$this->id .'/'. $this->image) : 'No profile',
        ];
    }
}
