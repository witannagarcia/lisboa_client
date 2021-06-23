<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            'restaurant_id' => $this->restaurant_id,
            'name' => $this->name,
            'image_banner' => $this->image_banner ? env('APP_URL').Storage::url($this->image_banner):NULL,
            'image_icon' => $this->image_icon ? env('APP_URL').Storage::url($this->image_icon):NULL,
        ];
    }
}
