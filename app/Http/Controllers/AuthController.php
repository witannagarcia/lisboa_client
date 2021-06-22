<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\PasswordReset;

use App\Mail\Test;
use App\Mail\Welcome;
use App\Mail\ForgotPassword;
use App\Models\QrSetting;
use App\Models\Restaurant;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->where('restaurant_id', env('RESTAURANT_ID'))->where('role', 'cliente')->first();

        if($user){

            if ($user->hasVerifiedEmail()) {
                if (Auth::attempt($credentials, $request->remember_me ? true : false)) {
                    $request->session()->regenerate();
    
                    switch (Auth::user()->role) {
                        case 'admin':
                            return redirect()->intended('/admin/dashboard');
                            break;
                        case 'cliente':
                            return redirect()->intended('/panel/dashboard');
                            break;
    
                        default:
                            # code...
                            break;
                    }
                }
            } else {
                return back()->withErrors([
                    'email' => 'Su cuenta no ha sido verificada',
                ]);
            }

        }else{
            return back()->withErrors([
                'email' => 'Este correo no esta registrado.',
            ]);

        }

        

        return back()->withErrors([
            'email' => 'La información proporcionada es erronea.',
        ]);
    }

    public function registerPost(Request $request)
    {
        $validated = $request->validate([
            'restaurant_name' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|max:20',
            'confirm' => 'required|same:password'
        ]);

        $hash = Str::random(12);

        $restaurant = new Restaurant();
        $restaurant->name = $request->restaurant_name;
        $restaurant->save();

        $qrSettings = new QrSetting();
        $qrSettings->restaurant_id = $restaurant->id;
        $qrSettings->logo = 0;
        $qrSettings->gradiant = 0;
        $qrSettings->save();

        $user = new User();
        $user->restaurant_id = $restaurant->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'cliente';
        $user->verification_hash = $hash;
        $user->password = Hash::make($request->password);
        $user->save();

        $data = [
            "user" => $user,
            "hash" => $hash,
        ];

        Mail::to("agarcia@witann.com")->send(new Test($data));

        return redirect('/')->with("success", "We sent an email to verify your account");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function testEmail()
    {
        return redirect('/')->with("success", "Hola");
    }

    public function accountVerification($hash)
    {
        $user = User::where('verification_hash', $hash)->first();

        if ($user) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->verification_hash = NULL;
            $user->save();

            try {
                Mail::to($user->email)->send(new Welcome($user));
            } catch (\Throwable $th) {
                //throw $th;
            }            

            Auth::login($user);
            return redirect()->intended('/panel/dashboard');
        }

        return redirect('/')->with("danger", "Verification hash doesn't exists.");
    }

    public function forgotPassword()
    {
        return view('auth.forgot_password');
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {

            $token = Str::random(36);

            $passwordRst = new PasswordReset();
            $passwordRst->email = $user->email;
            $passwordRst->token = $token;
            $passwordRst->save();

            Mail::to($user->email)->send(new ForgotPassword(["user" => $user, "token" => $token]));

            return redirect('/')->with(["success" => "We sent an email with instructions for recover your password."]);
        } else {
            return redirect()->back()->withErrors(["email" => "Email not registered"]);
        }
    }

    public function recoverPassword($token)
    {
        $reset = PasswordReset::where("token", $token)->first();

        if ($reset) {
            $user = User::where('email', $reset->email)->first();
            if ($user) {
                return view('auth.recover_password', ["user" => $user]);
            }
        }
    }

    public function recoverPasswordPost(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|max:20',
            'confirm' => 'required|same:password'
        ]);

        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();

        \DB::table('password_resets')->where('email', $user->email)->delete();

        if (Auth::attempt(["email" => $user->email, "password" => $user->password], $request->remember_me ? true : false)) {
            $request->session()->regenerate();

            return redirect()->intended('/panel/dashboard');
        }
    }

}
