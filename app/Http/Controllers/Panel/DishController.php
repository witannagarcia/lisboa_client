<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use App\Models\DishImage;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::paginate(8);
        return view('panel.dishes.index', ["dishes" => $dishes]);
    }

    public function create()
    {
        $categories = Category::where('restaurant_id', env('RESTAURANT_ID', '1'))->get();
        return view('panel.dishes.create', ["categories" => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "category_id" => "required",
            "preparation_time" => "required",
            "preview" => "required",
            "description" => "required",
            "price" => "required",
        ]);

        $dish = new Dish();
        $dish->restaurant_id = Auth::user()->restaurant_id;
        $dish->name = $request->name;
        $dish->category_id = $request->category_id;
        $dish->preparation_time = $request->preparation_time;
        $dish->preview = $request->preview;
        $dish->description = $request->description;
        $dish->price = $request->price;
        $dish->price_half = $request->price_half;
        $dish->save();

        $path = public_path() . "/images/dishes";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $pathDish = public_path() . "/images/dishes/" . $dish->id;
        if (!file_exists($pathDish)) {
            mkdir($pathDish, 0777, true);
        }

        $images = $request->file('files');

        if ($images) {
            foreach ($images as $image) {

                if (is_file($image)) {
                    $imageName = Str::random(24) . '.' . $image->getClientOriginalExtension();
                    $directory = public_path() . '/images/dishes/' . $dish->id . '/';
                    //$image->move($directory, $imageName);
                    Storage::disk('public')->put('/images/dishes/' . $dish->id . '/'.$imageName, file_get_contents($image));

                    $productImage = new DishImage();
                    $productImage->dish_id = $dish->id;
                    $productImage->url = '/images/dishes/' . $dish->id . '/' . $imageName;
                    $productImage->save();
                }
            }
        }

        return redirect('/panel/platillos')->with("success", "Platillo creado exitosamente.");
    }

    public function edit($id)
    {
        $dish = Dish::find($id);
        $categories = Category::where('restaurant_id', env('RESTAURANT_ID', '1'))->get();
        return view('panel.dishes.edit', ["dish" => $dish, "categories" => $categories]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "category_id" => "required",
            "preparation_time" => "required",
            "preview" => "required",
            "description" => "required",
            "price" => "required",
        ]);

        $dish = Dish::find($id);
        $dish->name = $request->name;
        $dish->category_id = $request->category_id;
        $dish->preparation_time = $request->preparation_time;
        $dish->preview = $request->preview;
        $dish->description = $request->description;
        $dish->price = $request->price;
        $dish->price_half = $request->price_half;
        $dish->save();

        $images = $request->file('files');

        if ($images) {
            foreach ($images as $image) {

                if (is_file($image)) {
                    $imageName = Str::random(24) . '.' . $image->getClientOriginalExtension();
                    Storage::disk('public')->put('/images/dishes/' . $id . '/'.$imageName, file_get_contents($image));

                    $productImage = new DishImage();
                    $productImage->dish_id = $dish->id;
                    $productImage->url = '/images/dishes/' . $dish->id . '/' . $imageName;
                    $productImage->save();
                }
            }
        }

        return redirect('/panel/platillos')->with("success", "Platillo actualizado exitosamente.");
    }

    public function destroy(Request $request, $id)
    {
        $dish = Dish::find($id);

        if ($dish->has('images')) {
            foreach ($dish->images as $image) {
                $name = last(explode("/", $image->url));

                $path = public_path() . "/images/dishes/" . $id . '/' . $name;
                if (file_exists($path)) {
                    unlink($path);
                }
                $image->delete();
            };
        }

        $pathFolder = public_path() . "/images/dishes/" . $id;
        if (file_exists($pathFolder)) {
            rmdir($pathFolder);
        }

        $dish->delete();

        return redirect('/panel/platillos')->with("success", "Platillo eliminado exitosamente.");
    }
}
