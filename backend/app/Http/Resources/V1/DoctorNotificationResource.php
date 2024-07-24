<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorNotificationResource extends JsonResource
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
            'type'=>$this->type,
            'from'=>$this->sendFrom->first_name.' '.$this->sendFrom->last_name,
            'message'=>$this->message,
            'is_read'=>$this->is_read,
            'created_for'=>Carbon::parse($this->created_at)->diffForHumans(),
            'created_at'=>Carbon::parse($this->created_at)->toDateString(),
        ];
    }
}
