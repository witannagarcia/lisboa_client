<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\DishImage as DishImageResource;

class Dish extends JsonResource
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
            'price' => $this->price,
            'category_id' => $this->category_id,
            'preparation_time' => $this->price,
            'preview' => $this->preview,
            'description' => $this->description,
            'images' => DishImageResource::collection($this->images)
            //'created_at' => $this->created_at->format('d/m/Y'),
            //'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
