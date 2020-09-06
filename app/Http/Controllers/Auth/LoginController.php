<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailPasswordReset;
use Illuminate\Support\Str;
use App\User;
use App\PassRecovery;


class LoginController extends Controller
{

    public function login(Request $request)
    {
        $cEmail         =   $request->cEmail;
        $cContrasena    =   $request->cContrasena;

        $rpta = Auth::attempt(['email' => $cEmail, 'password' => $cContrasena, 'state' => 'A']);

        if ($rpta) {
            return response()->json([
                'authUser'  =>  Auth::user(),
                'code'      =>  200
            ]);
        } else {
            return response()->json([
                'code'      =>  401
            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'code'      =>  204
        ]);
    }
    public function sendToken(Request $request){

        $user = User::where('email', $request->email)->first();

        if(!isset($user->id_user)){

            return response()->json(['error' => 'Este correo no esta en nuestros registros.'], 401);
        }
        $token = Str::random(32);

        Mail::to($user)->send(new MailPasswordReset($token));

        $passwordReset = new PassRecovery();
        $passwordReset->email = $user->email;
        $passwordReset->token = $token;
        $passwordReset->save();
    }
    public function validateToken(Request $request){

        $passwordReset = PassRecovery::where('token', $request->token)->first();

        if (!isset($passwordReset->email)){
            return response()->json(['error' => 'Codigo invalido.'], 401);
        }

        $user = User::where('email', $passwordReset->email)->first();
        return response()->json($user, 200);

    }
    public function resetPassword(Request $request){
        if(!$request->ajax()) return redirect('/');
        //$user = user::select('email')->where('id_user', $request->id_user)->get();
        $user = User::where('id_user', $request->id_user)->first();
        $passwordReset = PassRecovery::where('email', $user->email)->first();
        $passwordReset->delete();

        $user->password = bcrypt($request->password);
        $user->save();
        //return response()->json($user);
    }
}

