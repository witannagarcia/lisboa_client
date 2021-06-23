<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('restaurant_id', Auth::user()->restaurant_id)->paginate(8);
        return view('panel.categories.index', ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "name" => "required"
            ]
        );

        $category = new Category();
        $category->restaurant_id = Auth::user()->restaurant_id;
        $category->name = $request->name;
        $category->save();

        $path = public_path() . "/images/categories";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $pathDish = public_path() . "/images/categories/" . $category->id;
        if (!file_exists($pathDish)) {
            mkdir($pathDish, 0777, true);
        }

        if ($request->has('image_banner')) {
            $image = $request->image_banner;
            $imageName = 'image_banner.' . $image->getClientOriginalExtension();
            $directory = public_path() . '/images/categories/' . $category->id . '/';
            $image->move($directory, $imageName);
            $category->image_banner = '/images/categories/' . $category->id . '/' . $imageName;
        }

        if ($request->has('image_icon')) {
            $image = $request->image_icon;
            $imageName = 'image_icon.' . $image->getClientOriginalExtension();
            $directory = public_path() . '/images/categories/' . $category->id . '/';
            $image->move($directory, $imageName);
            $category->image_icon = '/images/categories/' . $category->id . '/' . $imageName;
        }

        return redirect('/panel/categorias')->with("success", "Categoría creada exitosamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('panel.categories.edit', ["category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                "name" => "required"
            ]
        );

        $category = Category::find($id);
        $category->name = $request->name;


        $path = public_path() . "/images/categories";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $pathDish = public_path() . "/images/categories/" . $id;
        if (!file_exists($pathDish)) {
            mkdir($pathDish, 0777, true);
        }

        if ($request->has('image_banner')) {
            $image = $request->image_banner;
            $imageName = 'image_banner.' . $image->getClientOriginalExtension();
            $directory = public_path() . '/images/categories/' . $id . '/';
            $image->move($directory, $imageName);
            $category->image_banner = '/images/categories/' . $id . '/' . $imageName;
        }

        if ($request->has('image_icon')) {
            $image = $request->image_icon;
            $imageName = 'image_icon.' . $image->getClientOriginalExtension();
            $directory = public_path() . '/images/categories/' . $id . '/';
            $image->move($directory, $imageName);
            $category->image_icon = '/images/categories/' . $id . '/' . $imageName;
        }

        $category->save();

        return redirect('/panel/categorias')->with("success", "Categoría actualizada exitosamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
