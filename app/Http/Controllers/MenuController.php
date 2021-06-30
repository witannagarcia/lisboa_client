<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\Branch;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branch = Branch::find($request->query('branch_id'));
        $restaurant = Restaurant::find($branch->restaurant_id);
        return view('menu.index', ["restaurant"=>$restaurant, "branch"=>$branch]);
    }

    public function category($id)
    {
        $category = Category::find($id);
        $restaurant = Restaurant::find($category->restaurant_id);
        return view('menu.category', ["category"=>$category, "restaurant"=>$restaurant]);
    }

    public function dish($id)
    {
        $dish = Dish::find($id);
        $restaurant = Restaurant::find($dish->category->restaurant_id);
        $similars = Dish::where('category_id', $dish->category_id)->where('id', '!=', $id)->limit(5)->get();
        return view('menu.dish', ["restaurant"=>$restaurant, "dish"=>$dish, 'similars'=>$similars]);
    }
}
