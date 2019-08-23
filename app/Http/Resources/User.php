<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class User
 * @package App\Http\Resources
 */
class User extends JsonResource
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'join_type' => $this->join_type,
            'name' => $this->name,
            'profile_image' => $this->profile_image,
            'created_at' => (string)$this->created_at,
            'token' => $this->token,
        ];
    }
}
