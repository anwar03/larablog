<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user,
            'article_id' => $this->article_id,
            'comment' => $this->comment,
            'created_at' => date('d M Y', strtotime($this->create_at)),
            'updated_at' => date('d M Y', strtotime($this->updated_at)),
        ];
    }
}
