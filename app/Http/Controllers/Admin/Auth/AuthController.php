<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function profile()
    {
        $admin = auth()->guard('web')->user();

        return view('admin.auth.profile', compact('admin'));

    }
    public function updateProfile(Request $request)
    {

        $client = Auth::guard('web')->user();
        if ($request->password) {
            $client->password = bcrypt($request->password);
        }

        $client->update($request->except('password'));

        return back();

    }
    public function login()
    {
        return view('admin.auth.login');

    }
    public function loginCheck(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $messages = [
            'email.required' => 'الاميل يكون مطلوب',
            'password.required' => 'الباسورد يكون مطلوب',
        ];

        $this->validate($request, $rules, $messages);

        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        // Dump data
        $client = User::where('email', $request->email)->first();

        if ($client) {

            if (Auth::guard('web')->attempt($credentials)) {
                return redirect(route('admin.home'));
            } else {
                flash()->error("البيانات غير صحيحة");
                return back();
            }

        } else {
            flash()->error("البيانات غير صحيحة");
            return back();
        }

    }

    public function logout()
    {
        auth()->guard('web')->logout();
        return redirect(route('admin-login'));

    }
    public function forgot_password()
    {
        return view('admin.auth.forgot_password');
    }

    public function forgot_password_post()
    {
        $admin = Admin::where('email', request('email'))->first();
        if (!empty($admin)) {
            $token = app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data' => $admin, 'token' => $token]));
            session()->flash('success', trans('admin.the_link_reset_sent'));
            return back();
        }
        return back();
    }

}
