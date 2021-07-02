<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\QrSetting;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::where('restaurant_id', env('RESTAURANT_ID'))->get();
        return view('panel.branches.index', ["branches" => $branches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.branches.create');
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
                "name" => "required",
                "address" => "required",
                "ext_num" => "required",
                "suburb" => "required",
                "city" => "required",
                "state" => "required",
                "coordinates" => "required",
            ]
        );

        $branch = new Branch();
        $branch->name = $request->name;
        $branch->restaurant_id = env('RESTAURANT_ID');
        $branch->address = $request->address;
        $branch->ext_num = $request->ext_num;
        $branch->suburb = $request->suburb;
        $branch->city = $request->city;
        $branch->state = $request->state;
        $branch->coordinates = $request->coordinates;
        $branch->save();

        $qr = new QrSetting();
        $qr->branch_id = $branch->id;
        $qr->restaurant_id = env('RESTAURANT_ID');
        $qr->save();

        $setting = new Setting();
        $setting->branch_id = $branch->id;
        $setting->save();

        if(DB::table('branches')->where('restaurant_id', env('RESTAURANT_ID'))->count() < 2){
            session()->put('branch', $branch);
        }

        return redirect('/panel/sucursales')->with("success", "Sucursal creada exitosamente.");
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
        $branch = Branch::find($id);
        return view('panel.branches.edit', ["branch"=>$branch]);
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
                "name" => "required",
                "address" => "required",
                "ext_num" => "required",
                "suburb" => "required",
                "city" => "required",
                "state" => "required",
                "coordinates" => "required",
            ]
        );

        $branch = Branch::findOrFail($id);
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->ext_num = $request->ext_num;
        $branch->suburb = $request->suburb;
        $branch->city = $request->city;
        $branch->state = $request->state;
        $branch->coordinates = $request->coordinates;
        $branch->save();

        return redirect('/panel/sucursales')->with("success", "Sucursal modificada exitosamente.");
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
