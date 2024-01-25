<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'website' => $this->website,
            'instagram' => $this->instagram,
            'telegram' => $this->telegram,
            'youtube' => $this->youtube,
            'facebook' => $this->facebook,
            'bio' => $this->bio,
            'certificate' => $this->certificate,
            'logo' => $this->logo,
            'location' => $this->location,
            'address' => $this->address,
            'district_id' => $this->district_id,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
        ];
    }
}
