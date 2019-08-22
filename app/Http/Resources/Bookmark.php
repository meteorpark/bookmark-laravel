<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Bookmark extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'url' => $this->url,
            'site_name' => $this->site_name,
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->description,
            'created_at' => (string)$this->created_at,
        ];
    }
}
