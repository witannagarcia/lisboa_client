<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('branch_id', session()->get('branch')->id)->first();
        return view('panel.settings.index', ["settings" => $settings]);
    }

    public function update(Request $request)
    {

        $set = Setting::where('restaurant_id', Auth::user()->restaurant_id)->first();

        if ($request->hasFile('logo_setting')) {

            if ($set->logo !== NULL) {
                $name = last(explode("/", Auth::user()->restaurant->setting->logo));
            }
            $image = $request->logo_setting;
            $imageName = 'logo_' . Str::random(12) . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put('/images/restaurants/' . Auth::user()->restaurant_id. '/'.$imageName, file_get_contents($image));
            $asset = '/images/restaurants/' . Auth::user()->restaurant_id . '/' . $imageName;
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
