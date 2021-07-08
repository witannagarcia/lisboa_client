<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\FirebaseService;

use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDish;

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
        $table = $request->query('table') ? $request->query('table') : NULL;
        return view('menu.index', ["restaurant" => $restaurant, "branch" => $branch, "table" => $table]);
    }

    public function category(Request $request, $id)
    {
        $category = Category::find($id);
        $branch = Branch::find($request->query('branch_id'));
        $table = $request->query('table') ? $request->query('table') : NULL;
        return view('menu.category', ["category" => $category, "branch" => $branch, "table" => $table]);
    }

    public function dish(Request $request, $id)
    {
        $dish = Dish::find($id);
        $branch = Branch::find($request->query('branch_id'));
        $similars = Dish::where('category_id', $dish->category_id)->where('id', '!=', $id)->limit(5)->get();
        $table = $request->query('table') ? $request->query('table') : NULL;
        return view('menu.dish', ["branch" => $branch, "dish" => $dish, 'similars' => $similars, 'table' => $table]);
    }

    public function addDish(Request $request)
    {
        $dishes = session()->exists('order') ? session()->get('order') : [];

        $dish = Dish::find($request->dish_id);

        $image = $dish->images()->exists() ? Storage::disk('public')->url($dish->image->url) : "";

        array_push($dishes, ["image" => $image,"dish_id"=>$request->dish_id, "name" => $dish->name, "price" => $dish->price, "special_instructions" => $request->special_instructions]);

        $request->session()->put('order', $dishes);

        return redirect()->back()->with('success', 'Su platillo se agrego correctamente.');
    }

    public function order(Request $request)
    {
        $orderDishes = session()->get('order');

        $branch = Branch::find($request->query('branch_id'));

        $order = new Order();
        $order->restaurant_id = $branch->restaurant_id;
        $order->branch_id = $request->query('branch_id');
        $order->branch_table_id = $request->query('table');
        $order->status = 'creado';
        $order->save();

        foreach ($orderDishes as $key => $orderDish) {
            $dish = new OrderDish();
            $dish->order_id = $order->id;
            $dish->dish_id = $orderDish["dish_id"];
            $dish->special_instructions = $orderDish["special_instructions"];
            $dish->save();
        }

        $restaurant = Restaurant::find($branch->restaurant_id);

        $data = ["table"=>$request->query('table'), "restaurant_name"=>$restaurant->name, "branch"=>$branch->name,"user_name"=>"", "status"=>"creado"];
        
        $firebase = new FirebaseService();
        $firebase->saveOrder($data);

        session()->forget('order');

        return redirect()->back()->with('success', 'Su orden se solicitó correctamente.');
    }

    public function cancelOrder(Request $request)
    {
        session()->forget('order');
        return redirect()->back()->with('success', 'Su orden se canceló correctamente.');
    }
}
