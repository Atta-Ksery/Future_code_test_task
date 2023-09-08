<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userPhotoUrl = $this->getFirstMediaUrl('user_photo');
        
        return [
            'id'                => $this->id,
            'fistName'          => $this->first_name,
            'lastName'          => $this->last_name,
            'email'             => $this->email,
            'user_photo_URL'    => $userPhotoUrl
        ];
    }
}
