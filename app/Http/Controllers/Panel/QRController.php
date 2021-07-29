<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\QrSetting;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function index()
    {
        $qrSetting = QrSetting::where('branch_id', session()->get('branch')->id)->first();
        $settings = Setting::where('branch_id', session()->get('branch')->id)->first();
        $categories = Category::where('branch_id', session()->get('branch')->id)->orderBy('order', 'ASC')->get();
        $hex = $qrSetting->color;
        [$r, $g, $b] = sscanf($hex, '#%02x%02x%02x');
        $hex = $qrSetting->color2;
        [$r2, $g2, $b2] = sscanf($hex, '#%02x%02x%02x');
        
        if($qrSetting->gradiant == 1){
            if ($qrSetting->logo == 1){
                $qrCode = QrCode::size(500)->format('png')->errorCorrection('H')->merge(Storage::disk('public')->url($settings->logo), .3, true)->gradient($r, $g, $b, $r2, $g2, $b2, 'radial')->style($qrSetting->type ? $qrSetting->type : 'square')->eye($qrSetting->eye_style ? $qrSetting->eye_style : 'square')->generate(url('/menu?branch_id='.session()->get('branch')->id));
            }else{
                $qrCode = QrCode::size(500)->format('png')->gradient($r, $g, $b, $r2, $g2, $b2, 'radial')->style($qrSetting->type ? $qrSetting->type : 'square')->eye($qrSetting->eye_style ? $qrSetting->eye_style : 'square')->generate(url('/menu?branch_id='.session()->get('branch')->id));
            }
        }else{
            if ($qrSetting->logo == 1){
                $qrCode = QrCode::size(500)->format('png')->errorCorrection('H')->merge(Storage::disk('public')->url($settings->logo), .3, true)->color($r, $g, $b)->style($qrSetting->type ? $qrSetting->type : 'square')->eye($qrSetting->eye_style ? $qrSetting->eye_style : 'square')->generate(url('/menu?branch_id='.session()->get('branch')->id));
            }else{
                $qrCode = QrCode::size(500)->format('png')->color($r, $g, $b)->style($qrSetting->type ? $qrSetting->type : 'square')->eye($qrSetting->eye_style ? $qrSetting->eye_style : 'square')->generate(url('/menu?branch_id='.session()->get('branch')->id));
            }

        }
        return view('panel.qr.index', ["QrSetting" => $qrSetting, "categories" => $categories, "qrCode" => $qrCode]);
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            foreach ($request->categories as $key => $cat) {
                DB::table('categories')->where('id', $cat["categoryId"])->update(["order"=>$cat["order"]]);
            }

            return response()->json(["msg"=>"Orden de categorías actulizado."],200);
        } else {
            $request->validate([
                'type' => 'required',
                'eye_style' => 'required',
                'color' => 'required',
            ]);

            $qrSetting = QrSetting::find($id);
            $qrSetting->type = $request->type;
            $qrSetting->eye_style = $request->eye_style;
            $qrSetting->color = $request->color;
            $qrSetting->color2 = $request->color2 ? $request->color2 : "#000000";
            $qrSetting->gradiant = $request->gradiant ? true : false;
            $qrSetting->logo = $request->logo ? true : false;
            $qrSetting->save();

            return back()->with('success', 'Código QR actualizado correctamente.');
        }
    }
}
