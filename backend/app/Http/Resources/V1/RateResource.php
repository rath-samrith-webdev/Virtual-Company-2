<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class RateResource extends JsonResource
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
            'content'=>$this->content,
            'user'=>RaterResource::make($this->user),
            'from'=>AppointmentMaker::make($this->user),
            'to'=>$this->hospital->name,
            'replies'=>RateReplyResource::collection($this->rateReply()->get()),
            'star'=>$this->star,
            'created_at'=>Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
