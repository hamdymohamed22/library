<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name, 
            "desc" => $this->desc, 
            "image" => $this->image, 
            "img_link" => asset('storage')."/".$this->image, 
        ];
    }
}
