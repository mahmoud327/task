<?php

namespace App\Http\Controllers\Admin\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;

class AdminController extends Controller
{

    function __construct()
    {

         $this->middleware('permission:المشرفين', ['only' => ['index']]);
         $this->middleware('permission:اضافة مشرف', ['only' => ['create','store']]);
         $this->middleware('permission:تعديل مشرف', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف مشرف', ['only' => ['destroy']]);

    }


public function index(Request $request)
{
    $data = Admin::orderBy('id','DESC')->paginate(5);
    return view('admin.admins.index',compact('data'))
    ->with('i', ($request->input('page', 1) - 1) * 5);
}


/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    $roles = Role::pluck('name','name')->all();
    return view('admin.admins.create',compact('roles'));
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{


    $this->validate($request, [

        'name' => 'required',
        'email' => 'required|email|unique:admins,email',
        'password' => 'required|same:confirm-password',
        'roles_name' => 'required'

    ]);


    $input = $request->all();



    $input['password'] = Hash::make($input['password']);

    $user = Admin::create($input);


    $user->assignRole($request->input('roles_name'));
    $user->save();
    flash()->success("تم اضافة معلومات المستخدم بنجاح");
    return redirect()->route('admin.index');
}


/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
    $user = Admin::find($id);
    return view('admin.admins.show',compact('user'));
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    $user = Admin::find($id);
    $roles = Role::pluck('name','name')->all();
    $userRole = $user->roles->pluck('name','name')->all();
    return view('admin.admins.edit',compact('user','roles','userRole'));
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
    // return $request->all();

    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:admins,email,'.$id,
        'password' => 'same:confirm-password',
        'roles_name' => 'required'
    ],

    [
        'name.required'        => 'ادخل الاسم',

        'email.required'        => 'ادخل البريد الالكتروني',
        'email.email'           => ' ex@ex.com ادخل البريد الالكتروني بهذه الهيئة',
        'email.unique'          => ' هذا البريد يستخدمه مشرف اخر',

        'password.same'         => 'كلمة المرور غير متطابقة',

        'roles_name.required'   => 'ادخل الصلاحيات'
    ]);

    $input = $request->all();

    if(!empty($input['password'])){

        $input['password'] = Hash::make($input['password']);
    }else{

        $input = $request->except(['password']);
        // $input = array_except($input,array('password'));
    }

    $user = Admin::find($id);

    $user->update($input);
    DB::table('model_has_roles')->where('model_id',$id)->delete();
    $user->assignRole($request->input('roles_name'));
    $user->save();
    flash()->success("تم تحديث معلومات المستخدم بنجاح");
    return redirect()->route('admin.index');
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
{
    Admin::find($request->user_id)->delete();
    flash()->success("تم حذف المستخدم بنجاح");
    return redirect()->route('admin.index');
}
}
