<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
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
            'user'=>RaterResource::make($this->user),
            'content'=>$this->content,
            'created_at'=>Carbon::parse($this->created_at)->toDateString(),
            'created_for'=>Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
