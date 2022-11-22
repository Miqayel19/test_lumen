<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    /**
     *
     * @param Request $request
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|min:5',
        ]);

        $user = new User();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->input('phone');
        $user->api_token = Str::random(40);
        $user->save();

        return response()->json('status => success');

    }

    /**
     *
     * @param Request $request
     */
    public function signIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if(Hash::check($request->input('password'), $user->password)){
            $api_token = Str::random(40);

            User::where('email', $request->input('email'))->update(['api_token' => $api_token]);

            return response()->json(['status' => 'success','api_token' => $api_token]);
        }else{
            return response()->json(['status' => 'failed'],401);
        }
    }

    public function sendRecoverPasswordLink(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(40);

        DB::table('password_resets')->insert([
            'email' => $request->input('email'),
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email', ['token' => $token], function($message) use($request){
            $message->to($request->input('email'));
            $message->subject('Reset Password');
        });

        return response()->json('message', 'Your password reset link sent to your email,please check the inbox!');
    }
    public function recoverPassword(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8',
        ]);

        $updatedPassword = DB::table('password_resets')
            ->where([
                'email' => $request->input('email'),
                'token' => $request->input('token')
            ])
            ->first();

        if(!$updatedPassword){
            return response()->json('message', 'Invalid token');
        }

        $user = User::where('email', $request->input('email'))
            ->update(['password' => Hash::make($request->input('password'))]);

        DB::table('password_resets')->where(['email'=> $request->input('email')])->delete();

        return response()->json('message', 'Your password has been changed!');
    }
    public function resetPassword(Request $request) {

    }
}
