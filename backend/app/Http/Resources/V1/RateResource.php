<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'from'=>$this->user->first_name.' '.$this->user->last_name,
            'to'=>$this->hospital->name,
            'replies'=>RateReplyResource::collection($this->rateReply()->get())
        ];
    }
}
