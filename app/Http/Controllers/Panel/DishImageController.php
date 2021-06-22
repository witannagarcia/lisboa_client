<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\DishImage;
use Illuminate\Http\Request;

class DishImageController extends Controller
{
    public function destroy($dish_id, $id)
    {
        $image = DishImage::find($id);
        $name = last(explode("/", $image->url));

        $path = public_path() . "/images/dishes/".$dish_id.'/'.$name;
        if (file_exists($path)) {
            unlink($path);
        }
        $image->delete();
        return redirect()->back()->with('success', 'Imagen eliminada exitosamente.');
    }
}
