<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;
class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.auth.changepassword');
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
      $model = Admin::findOrFail($id);

      return view('admin.auth.changepassword',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ], [
          'old_password.required' =>'يجب ادخال كلمة المرور القديمة',
          'password.required'     =>'يجب ادخال كلمة المرور الجديدة',
          'password.confirmed'    =>'يجب تأكيد كلمة المرور الجديد',
        ], [
            'old_password' => 'Your Password',
            'password' => 'new Password'
        ]);


        $user = Auth::guard('admin')->user();

        if (Hash::check($request->input('old_password'), $user->password)) {

            // The passwords match...
            // $user->password = $request->input('password');
            $user->password = bcrypt($request->input('password'));
            $user->save();
            //dd($user);

            flash()->success('تم تحديث كلمة المرور');
            return back();
        }else{
            flash()->error('كلمة المرور غير صحيحة');

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
