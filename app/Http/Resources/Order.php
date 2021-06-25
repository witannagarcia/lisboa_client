<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Location as LocationResource;

class Order extends JsonResource
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
            'status' => $this->status,
            'location' => $this->location_id ? new LocationResource($this->location):NULL,
        ];
    }
}
