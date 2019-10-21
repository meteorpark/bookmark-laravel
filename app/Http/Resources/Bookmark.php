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
            'id' => (string)$this->id,
            'category_id' => $this->category_id,
            'url' => $this->url,
            'site_name' => (string)$this->site_name,
            'title' => (string)$this->title,
            'image' => $this->image,
            'description' => (string)$this->description,
            'is_failed' => $this->is_failed,
            'created_at' => (string)$this->created_at,
        ];
    }
}
