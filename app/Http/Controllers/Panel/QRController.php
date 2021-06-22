<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\QrSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function index()
    {
        $qrSetting = Auth::user()->restaurant->QrSetting;
        return view('panel.qr.index', ["QrSetting"=>$qrSetting]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'eye_style' => 'required',
            'color'=>'required',
        ]);

        $qrSetting = QrSetting::find($id);
        $qrSetting->type = $request->type;
        $qrSetting->eye_style = $request->eye_style;
        $qrSetting->color = $request->color;
        $qrSetting->color2 = $request->color2 ? $request->color2:"#000000";
        $qrSetting->gradiant = $request->gradiant ? true:false;
        $qrSetting->logo = $request->logo ? true:false;
        $qrSetting->save();

        return back()->with('success', 'Código QR actualizado correctamente.');
    }
}
