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
        $table = NULL;
        return view('menu.index', ["restaurant"=>$restaurant, "branch"=>$branch, "table"=>$table]);
    }

    public function category($id)
    {
        $category = Category::find($id);
        $branch = Branch::find($category->branch_id);
        return view('menu.category', ["category"=>$category, "branch"=>$branch]);
    }

    public function dish($id)
    {
        $dish = Dish::find($id);
        $branch = Branch::find($dish->category->branch_id);
        $similars = Dish::where('category_id', $dish->category_id)->where('id', '!=', $id)->limit(5)->get();
        return view('menu.dish', ["branch"=>$branch, "dish"=>$dish, 'similars'=>$similars]);
    }
}
