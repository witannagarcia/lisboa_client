<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Element;
use App\Models\Branch;
use App\Models\BranchTable;
use App\Models\QrSetting;
use Illuminate\Support\Facades\Storage;
use QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as FacadesQrCode;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(QrCode::size(200)->generate(url('/menu?branch_id='.session()->get('branch')->id)));
        if ($request->ajax()) {
            $table = BranchTable::where('branch_id', session()->get('branch')->id)->first();
            $elements = Element::where('branch_id', session()->get('branch')->id)->get();
            return response()->json(["msg" => "", "data" => ["elements" => $elements, "table" => $table]]);
        } else {
            $branch = Branch::find(session()->get('branch')->id);
            return view('panel.tables.index', ["branch" => $branch]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $QrSetting = QrSetting::where('branch_id', session()->get('branch')->id)->first();
        $hex = $QrSetting->color;
        [$r, $g, $b] = sscanf($hex, '#%02x%02x%02x');
        $hex = $QrSetting->color2;
        [$r2, $g2, $b2] = sscanf($hex, '#%02x%02x%02x');
        if ($QrSetting->gradiant == 1) {
            if ($QrSetting->logo == 1) {
                $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '',  QrCode::size(200)->mergeString(Storage::disk('public')->url(session()->get('branch')->setting->logo), .3)->gradient($r, $g, $b, $r2, $g2, $b2, 'radial')->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu?branch_id=' . session()->get('branch')->id.'&table='.$id)));
            } else {
                $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '',  QrCode::size(200)->gradient($r, $g, $b, $r2, $g2, $b2, 'radial')->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu?branch_id=' . session()->get('branch')->id.'&table='.$id)));
            }
        } else {
            if ($QrSetting->logo == 1) {
                $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '',  QrCode::size(200)->mergeString(Storage::disk('public')->url(session()->get('branch')->setting->logo), .3)->color($r, $g, $b)->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu?branch_id=' . session()->get('branch')->id.'&table='.$id)));
            } else {
                $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '',  QrCode::size(200)->color($r, $g, $b)->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu?branch_id=' . session()->get('branch')->id.'&table='.$id)));
            }
        }
        
        return response()->json(["qrCode" => $qrCode]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if ($request->type == 'size') {

            $table = BranchTable::where('branch_id', session()->get('branch')->id)->first();
            $table->width = $request->width;
            $table->height = $request->height;
            $table->save();

            return response()->json(["msg" => "Elementos actualizados correctamente."], 200);
        } else {

            session()->get('branch')->elements()->delete();

            foreach ($request->elements as $element) {
                $newElement = new Element();
                $newElement->branch_id = session()->get('branch')->id;
                $newElement->width = $element["width"];
                $newElement->height = $element["height"];
                $newElement->type = $element["type"];
                $newElement->number = in_array($element["type"], ["table", "circle", "triangle"]) ? $element["number"] : NULL;
                $newElement->left = $element["left"];
                $newElement->top = $element["top"];
                $newElement->scaleX = $element["scaleX"];
                $newElement->scaleY = $element["scaleY"];
                $newElement->save();
            }


            return response()->json(["msg" => "Elementos actualizados correctamente."], 200);
        }
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
