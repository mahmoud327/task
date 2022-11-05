<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Models\Office;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserController extends Controller
{

    function __construct()
    {

         $this->middleware('permission:المستخدمين', ['only' => ['index']]);
         $this->middleware('permission:اضافة مستخدم', ['only' => ['create','store']]);
         $this->middleware('permission:تعديل مستخدم', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف مستخدم', ['only' => ['destroy']]);
        $this->middleware('permission:تفعيل مستخدم', ['only' => ['user.activate','user.deactivate']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $user)
    {

         return $user->render('admin.users.index');

    }



    public function create()
    {
        $offices = Office::pluck('name', 'id');
        $selectedID = Office::first();
        return view('admin.users.create', compact('offices', 'selectedID'));
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
            'name'                      => 'required',
            'email'                     => 'required|email|unique:users,email',
            'phone'                   => 'required|numeric|unique:users,phone',
            'office_id'                 => 'required',
            'activate'                  => 'required',
            'time'                      => 'required',
            'time_end'                      => 'required',
            'branch'                    => 'required',
            'discount_per'               => 'required|numeric',
            'password'                  => 'required|min:8',
            'password_confirmation'     => 'required|min:8|same:password',
        ],
        [
            'name.required'                  => 'يجب عليك ادخال الاسم',
            'email.required'                 => 'يجب عليك ادخال البريد الالكتروني',
            'email.unique'                   => 'هذا الحساب يمتلكه شخص اخر',
            'email.email'                    => 'ادخل الحساب بهذه الهيئة ex@ex.com',
            'activate.required'               => 'حالة الموظف مطلوبه',

            'discount_per.required'           => 'نسبة الخصم للموظف مطلوبه',
            'discount_per.numeric'             => 'نسبة الخصم  تكون رقم',
            'branch.required'                 => '  فرع المكتب مطلوب',
            'time.required'                  => 'وقت  بداية العمل مطلوب',
            'time_end.required'               => 'وقت انتهاء العمل',

            'phone.required'                 => 'يجب عليك ادخال رقم الهاتف',
            'phone.numeric'                   => ' الهاتف يجب ان يكون رقم',
            'phone.unique'                     => 'رقم التلفون موجود بالفعل ',
            'office_id.required'             => 'يجب عليك اختيار اسم المكتب',
            'password.required'              => 'يجب عليك ادخال كلمة المرور',
            'password.min'                   => 'يجب عليك ادخال كلمة مرور لا تقل عن 8 حروف',
            'password_confirmation.same'     => 'يجب عليك ان تدخل كلمة لمرور متطابقة',

        ]);

        $input = $request->all();


        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        flash()->success("تم اضافة معلومات المستخدم بنجاح");
        return redirect()->route('user.index');
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

        $user = User::find($id);
        $offices = Office::pluck('name', 'id');
        $selectedID = $user->office_id;

        return view('admin.users.edit',compact('user', 'offices', 'selectedID'));

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
            'name'                      => 'required',
            'email'                     => 'required|email|unique:users,email,'.$id,
            'phone'                 => 'required|numeric|unique:users,phone,'.$id,
            'office_id'                 => 'required',
            'activate'                  => 'required',
            'password'                  => 'sometimes|nullable|min:8',
            'password_confirmation'     => 'sometimes|nullable|min:8|same:password',
            'time'                      => 'required',
            'time_end'                      => 'required',
            'branch'                    => 'required',
            'discount_per'               => 'required|numeric',

        ],
        [
            'name.required'                  => 'يجب عليك ادخال الاسم',
            'email.required'                 => 'يجب عليك ادخال البريد الالكتروني',
            'email.unique'                   => 'هذا الحساب يمتلكه شخص اخر',
            'email.email'                    => 'ادخل الحساب بهذه الهيئة ex@ex.com',

            'phone.required'                 => 'يجب عليك ادخال رقم الهاتف',
            'phone.unique'                   => 'رقم التلفون موجود بالفعل ',
            'phone.numeric'                  => ' الهاتف يجب ان يكون رقم',

            'activate.required'               => 'حالة الموظف مطلوبه',
        
            'discount_per.required'           => 'نسبة الخصم للموظف مطلوبه',
            'discount_per.numeric'             => 'نسبة الخصم  تكون رقم',
            'branch.required'                 => '  فرع المكتب مطلوب',
            'time.required'                  => 'وقت  بداية العمل مطلوب',
            'time_end.required'               => 'وقت انتهاء العمل',


            'office_id.required'             => 'يجب عليك اختيار اسم المكتب',

            'password.min'                   => 'يجب عليك ادخال كلمة مرور لا تقل عن 8 حروف',
            'password_confirmation.same'     => 'يجب عليك ان تدخل كلمة لمرور متطابقة',

        ]);



        if($request->password)
        {
            $request->password = Hash::make($request->password );
            $input = $request->all();
        }
        else
        {
            $input = $request->except('password');
        }

        $user = User::findOrFail($id);
        $user->update($input);
        flash()->success("تم تعديل معلومات المستخدم بنجاح");
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $record = User::findOrFail($request->user_id);

        $record->delete();
        flash()->success("تم الحذف بنجاح");
        return back();
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->activate = 1;
        $user->save();

        flash()->success('تم التفعيل');
        return back();
    }
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->activate = 0;
        $user->save();

        flash()->success('تم إلغاء التفعيل');
        return back();
    }

}
