<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\QrSetting;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function index()
    {
        echo Hash::make('$Colima2021');
        dd();
        $qrSetting = session()->get('branch')->QrSetting;
        $categories = Category::where('branch_id', session()->get('branch')->id)->orderBy('order', 'ASC')->get();
        return view('panel.qr.index', ["QrSetting" => $qrSetting, "categories" => $categories]);
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
