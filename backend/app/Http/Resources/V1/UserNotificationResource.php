<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data=$this->sendFrom;
        if($data->hospital){
            $from=$data->hospital->name;
        }else{
            $from=$data->first_name;
        }
        return [
            'id'=>$this->id,
            'type'=>$this->type,
            'user'=>AppointmentMaker::make($this->user),
            'from'=>$from,
            'message'=>$this->message,
            'is_read'=>$this->is_read,
            'created_for'=>Carbon::parse($this->created_at)->diffForHumans(),
            'created_at'=>Carbon::parse($this->created_at)->toDateString(),
        ];
    }
}
