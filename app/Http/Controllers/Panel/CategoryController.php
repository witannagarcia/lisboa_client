<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('branch_id', session()->get('branch')->id)->paginate(8);
        return view('panel.categories.index', ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('category_id', NULL)->get();
        return view('panel.categories.create', ["categories"=>$categories]);
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
        $category->branch_id = session()->get('branch')->id;
        $category->category_id = $request->category_id;
        $category->name = $request->name;
        $category->save();

        if ($request->hasFile('image_banner')) {
            $image = $request->image_banner;
            $imageName = 'image_banner.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('/images/categories/' . $category->id . '/'.$imageName, file_get_contents($image));
            \DB::table('categories')->where('id', $category->id)->update(['image_banner'=>'/images/categories/' . $category->id . '/' . $imageName]);
        }

        if ($request->hasFile('image_icon')) {
            $image = $request->image_icon;
            $imageName = 'image_icon.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('/images/categories/' . $category->id . '/'.$imageName, file_get_contents($image));
            \DB::table('categories')->where('id', $category->id)->update(['image_icon'=>'/images/categories/' . $category->id . '/' . $imageName]);
        }

        $category->save();
        

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
        $category = Category::find($id);
        return response()->json(["msg"=>"", "data"=>$category->nodes], 200);
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
        $categories = Category::where('category_id', NULL)->get();
        return view('panel.categories.edit', ["category" => $category, "categories" => $categories]);
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

        if ($request->hasFile('image_banner')) {
            $image = $request->image_banner;
            $imageName = 'image_banner.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('/images/categories/' . $category->id . '/'.$imageName, file_get_contents($image));
            $category->image_banner = '/images/categories/' . $id . '/' . $imageName;
        }

        if ($request->hasFile('image_icon')) {
            $image = $request->image_icon;
            $imageName = 'image_icon.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('/images/categories/' . $category->id . '/'.$imageName, file_get_contents($image));
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
        $category = Category::find($id);
        $category->delete();

        return redirect('/panel/categorias')->with("success", "Categoría eliminada exitosamente.");
    }
}
