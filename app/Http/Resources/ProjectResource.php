<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'detail' => $this->detail,
            'likes' => $this->likes,
            'date' => $this->datee,
            'link' => $this->link,
            'elements' => $this->elements,
            'pages' => $this->pages
        ];
    }
}
