<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Resources\Json\JsonResource;

class Location extends JsonResource
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
            'name' => $this->name,
            'ext_num' => $this->ext_num,
            'suburb' => $this->suburb,
            'city' => $this->city,
            'state' => $this->state,
            'coordinates' => $this->coordinates
        ];
    }
}
