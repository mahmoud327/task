<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\DataTables\OfficeDataTable;
use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Place;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class OfficeController extends Controller
{


    function __construct()
    {

         $this->middleware('permission:المكاتب', ['only' => ['index']]);
         $this->middleware('permission:اضافة مكتب', ['only' => ['create','store']]);
         $this->middleware('permission:تعديل مكتب', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف مكتب', ['only' => ['destroy']]);

    }

    public function index(OfficeDataTable $office)
    {
         return $office->render('admin.offices.index');
    }

    public function create()
    {
        return view('admin.offices.create');
    }


    public function store(Request $request)
    {


        $this->validate($request, [
            'name'                      => 'required',
            'email'                     => 'required|email|unique:offices,email',
            'phone'                     => 'required|numeric|unique:offices,phone',
            'address'                   => 'required',
            'place1'                   => 'numeric',
            'place2'                   => 'numeric',


        ],
        [
            'name.required'                  => 'يجب عليك ادخال الاسم',
            'email.required'                 => 'يجب عليك ادخال البريد الالكتروني',
            'email.unique'                   => 'هذا الحساب يمتلكه مكتب اخر',
            'email.email'                    => 'ادخل الحساب بهذه الهيئة ex@ex.com',

            'phone.required'                 => 'يجب عليك ادخال رقم الهاتف',
            'phone.unique'                   => 'هذا الهاتف يمتلكه مكتب اخر',
            'phone.numeric'                   => ' الهاتف يجب ان يكون رقم    ',


            'address.required'               => 'يجب عليك ادخال العنوان',

            'place1.numeric'               => 'يجب  ادخال الرحله الذهاب رقم ',
            'place2.numeric'               => 'يجب  ادخال الرحله العوده رقم ',




        ]);
        $this->validate($request, $rules, $messages);


        $office =  Office::create([

            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address
        ]);


        for($i=0 ; $i < count($request->title) ; $i++)
        {
            Place::create([

                'name'          => $request->title[$i],
                'price'         => $request->price[$i],
                'price2'         => $request->price2[$i],
                'office_id'     => $office->id
            ]);
        }




        flash()->success("تم اضافة مكتب بنجاح");
        return redirect()->route('office.index');
    }

    public function edit($id)
    {
        $office = Office::find($id);
        return view('admin.offices.edit',compact('office'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name'                      => 'required',
            'email'                     => 'required|email|unique:offices,email,'.$id,
            'phone'                     => 'required|numeric|unique:offices,phone,'.$id,
            'address'                   => 'required',

        ],
        [
            'name.required'                  => 'يجب عليك ادخال الاسم',
            'email.required'                 => 'يجب عليك ادخال البريد الالكتروني',
            'email.unique'                   => 'هذا الحساب يمتلكه مكتب اخر',
            'email.email'                    => 'ادخل الحساب بهذه الهيئة ex@ex.com',

            'phone.required'                 => 'يجب عليك ادخال رقم الهاتف',
            'phone.unique'                   => 'هذا الهاتف يمتلكه مكتب اخر',
            'phone.numeric'                   => ' الهاتف يجب ان يكون رقم    ',


            'address.required'               => 'يجب عليك ادخال العنوان',


        ]);


        $office = Office::findOrFail($id);

        for($i=0 ; $i < count($office->places) ; $i++)
        {
            $office->places[$i]->delete();
        }

        



        $office->update($request->all());

       if($request->input('title'))
       {


        for($i=0 ; $i < count($request->title) ; $i++)
        {
            Place::create([

                'name'          => $request->title[$i],
                'price'         => $request->price[$i],
                'price2'         => $request->price2[$i],
                'office_id'     => $office->id
            ]);
        }
     }
        flash()->success("تم تعديل معلومات المكتب بنجاح");
        return redirect()->route('office.index');
    }

    public function destroy($id, Request $request)
    {
        $record = Office::findOrFail($request->office_id);

        $record->delete();
        flash()->success("تم الحذف بنجاح");
        return back();
    }

    public function multi_delete() {
		if (is_array(request('item'))) {
			Office::destroy(request('item'));
		} else {
			Office::find(request('item'))->delete();
		}
		session()->flash('success','تم الحذف بنجاح');
		return redirect()->back();
	}


}
