<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Element;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $elements = Element::where('branch_id', session()->get('branch')->id)->get();
            return response()->json(["msg"=>"", "data"=>$elements]);
        } else {
            return view('panel.tables.index');
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
        //
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
        session()->get('branch')->elements()->delete();

        foreach($request->elements as $element){
            $newElement = new Element();
            $newElement->branch_id = session()->get('branch')->id;
            $newElement->width = $element["width"];
            $newElement->height = $element["height"];
            $newElement->type = $element["type"];
            $newElement->number = in_array($element["type"], ["table", "circle", "triangle"]) ? $element["number"]:NULL; 
            $newElement->left = $element["left"];
            $newElement->top = $element["top"];
            $newElement->scaleX = $element["scaleX"];
            $newElement->scaleY = $element["scaleY"];
            $newElement->save();
        }

        return response()->json(["msg"=>"Elementos actualizados correctamente."],200);
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
