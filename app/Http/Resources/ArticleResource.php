<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user,
            'title' => $this->title,
            'text' => $this->text,
            'created_at' => date('d M Y', strtotime($this->create_at)),
            'updated_at' => date('d M Y', strtotime($this->updated_at)),
        ];
    }
}
