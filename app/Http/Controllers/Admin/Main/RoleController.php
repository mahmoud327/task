<?php

namespace App\Http\Controllers\Admin\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class RoleController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */


    function __construct()
    {

         $this->middleware('permission:الصلاحيات', ['only' => ['index']]);
         $this->middleware('permission:اضافة صلاحيه', ['only' => ['create','store']]);
         $this->middleware('permission:تعديل صلاحيه', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف صلاحيه', ['only' => ['destroy']]);

    }


    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->get();
        return view('admin.roles.index',compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create',compact('permission'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ];

        $messages = [
            'name.required'         => 'اسم الصلاحية موجود بالفعل',
            'name.unique'           => 'اسم الصلاحية مطلوب',
            'permission.required'   => 'الصلاحيات مطلوب'
        ];

        $this->validate($request, $rules, $messages);

        $role = Role::create(['guard_name' => 'admin', 'name' => $request->input('name')]);

        $role->syncPermissions($request->input('permission'));

        flash()->success('تمت الاضافة بنجاح');

        return redirect()->route('roles.index');
    }
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
                                     ->where("role_has_permissions.role_id",$id)->get();
        return view('admin.roles.show',compact('role','rolePermissions'));
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {

        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
                             ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
        return view('admin.roles.edit',compact('role','permission','rolePermissions'));
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        flash()->success("تم التعديل بنجاح");

        return redirect()->route('roles.index');


    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id, Request $request)
    {
        DB::table("roles")->where('id',$request->role_id)->delete();
        flash()->success('تم الحذف بنجاح');

        return redirect()->route('roles.index');

    }
}
