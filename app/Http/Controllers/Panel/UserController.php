<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('restaurant_id', env('RESTAURANT_ID'))->get();
        return view('panel.users.index', ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::where('restaurant_id', env('RESTAURANT_ID'))->get();
        return view('panel.users.create', ["branches" => $branches]);
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
                "password" => "required",
                "email" => "required",
                "role" => "required",
                "branch_id" => "required"
            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->restaurant_id = env('RESTAURANT_ID');
        $user->branch_id = $request->branch_id;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect('/panel/usuarios')->with("success", "Usuario creada exitosamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $branches = Branch::where('restaurant_id', env('RESTAURANT_ID'))->get();
        return view('panel.users.edit', ["user" => $user, "branches" => $branches]);
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
                "email" => "required",
                "branch_id" => "required"
            ]
        );

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->branch_id = $request->branch_id;

        if ($request->role !== NULL) {
            $user->role = $request->role;
        }

        if ($request->password !== NULL) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/panel/usuarios')->with("success", "Usuario actualizado exitosamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/panel/usuarios')->with("success", "Usuario eliminado exitosamente.");
        
    }
}
