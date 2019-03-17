<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'user'=> $this->user->name,
            'created_at'=> $this->created_at->diffForHumans(),
            'body'=> $this->body,
            'user_id'=>$this->user_id,
            'question_slug'=>$this->question->slug,
            'like_count'=>$this->likes->count(),
            'liked'=>!!$this->likes->where('user_id',auth()->id())->count(),
        ];
    }
}
