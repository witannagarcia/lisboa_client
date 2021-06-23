<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Dish as DishResource;

use App\Models\Dish;

class DishController extends BaseController
{
    public function index(Request $request)
    {
        $queries = $request->query();
        if(count($queries) > 0)
        $dishes = Dish::where($queries)->where('restaurant_id', env('RESTAURANT_ID'))->with(['images'])->get();
        else
        $dishes = Dish::where('restaurant_id', env('RESTAURANT_ID'))->with(['images'])->get();

        return $this->sendResponse(DishResource::collection($dishes), 'Dishes retrieved successfully.');
    }

    public function show($id)
    {
        $dish = new DishResource(Dish::findOrFail($id));
        $dish->images;
        return $this->sendResponse($dish, 'Dish retrieved successfully.');
    }
}
