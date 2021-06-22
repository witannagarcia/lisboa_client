<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('restaurant_id', env('RESTAURANT_ID'))->first();
        return view('panel.settings.index', ["settings" => $settings]);
    }

    public function update(Request $request)
    {

        $set = Setting::where('restaurant_id', Auth::user()->restaurant_id)->first();

        if ($request->has('logo')) {

            if (Auth::user()->restaurant->setting->logo !== NULL) {
                $name = last(explode("/", Auth::user()->restaurant->setting->logo));
                $pathDelete = public_path() . "/images/restaurants/" . Auth::user()->restaurant_id . '/' . $name;
                if (file_exists($pathDelete)) {
                    unlink($pathDelete);
                }
            }

            $ext = explode('/', mime_content_type($request->logo))[1];
            $image = $request->logo;  // your base64 encoded
            $image = str_replace('data:image/' . $ext . ';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'logo_' . Str::random(12) . '.' . $ext;

            $path = public_path() . "/images/restaurants";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $path = public_path() . "/images/restaurants/" . Auth::user()->restaurant_id;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            \File::put(public_path() . '/images/restaurants/' . Auth::user()->restaurant_id . '/' . $imageName, base64_decode($image));
            $asset = asset('/images/restaurants/' . Auth::user()->restaurant_id . '/' . $imageName);


            $set->logo = $asset;
        }
        $set->name = $request->name;
        $set->phone = $request->phone;
        $set->website = $request->website;
        $set->address = $request->address;
        $set->save();
        return redirect()->back()->with('success', 'Información del restaurante actualizada exitosamente.');

        
    }
}
