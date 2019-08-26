<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookmarkCategory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => (string)$this->id,
            'user_id' => (string)$this->user_id,
            'name' => $this->name,
            'rank' => (string)$this->rank,
        ];
    }
}
