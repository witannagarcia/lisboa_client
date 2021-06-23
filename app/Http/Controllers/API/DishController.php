<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Dish as DishResource;

use App\Models\Dish;
use App\Models\Category;

class DishController extends BaseController
{
    public function index(Request $request)
    {
        $queries = $request->query();
        $categoriesIds = Category::where('restaurant_id', env('RESTAURANT_ID'))->pluck('id');
        if(count($queries) > 0)
        $dishes = Dish::where($queries)->whereIn('category_id', $categoriesIds)->with(['images'])->get();
        else
        $dishes = Dish::whereIn('category_id', $categoriesIds)->with(['images'])->get();

        return $this->sendResponse(DishResource::collection($dishes), 'Dishes retrieved successfully.');
    }

    public function show($id)
    {
        $dish = new DishResource(Dish::findOrFail($id));
        $dish->images;
        return $this->sendResponse($dish, 'Dish retrieved successfully.');
    }
}
