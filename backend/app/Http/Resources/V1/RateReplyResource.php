<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateReplyResource extends JsonResource
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
            'rate_id'=>$this->rate_id,
            'user'=>$this->user->first_name.' '.$this->user->last_name,
            'content'=>$this->content
        ];
    }
}
