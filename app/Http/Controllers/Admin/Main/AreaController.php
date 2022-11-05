<?php

namespace App\Http\Controllers\Admin\Main;

use App\DataTables\AreaDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;



class AreaController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AreaDataTable $type)
   {

        return $type->render('admin.areas.index');

        // return view('layouts.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.areas.create');
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

            'cost'          => 'required|numeric',
            'area_name'          => 'required|unique:areas,area_name',
          ];

          $messages = [
            'cost.required'         => 'التكلفه  مطلوب',
            'area_name.required'        => 'اسم المنطقه  مطلوب',
            'area_name.unique'        => 'اسم المنطقه  موجود من قبل',
            'cost.numeric'        => ' يجب اب يكون رقم مطلوب',

          ];

          $this->validate($request, $rules, $messages);
          $record = Area::create($request->all());

          flash()->success("تم إضافة المنطقه بنجاح");
          return redirect(route('areas.index'));
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
        $model = Area::findOrFail($id);
        return view('admin.areas.edit', compact('model'));
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
        $rules = [

            'cost'          => 'required|numeric',
            'area_name'          => 'required|unique:areas,area_name,'.$id,
          ];

          $messages = [
            'cost.required'         => 'التكلفه  مطلوب',
            'area_name.required'        => 'اسم المنطقه  مطلوب',
            'area_name.unique'        => 'اسم المنطقه  موجود من قبل',
            'cost.numeric'        => ' يجب اب يكون رقم مطلوب',

          ];

        $this->validate($request, $rules, $messages);

        $record = Area::findOrFail($id);
        $record->update($request->all());
        flash()->success("تم التعديل بنجاح");
        return redirect(route('areas.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        $record = Area::findOrFail($request->drive_id);
        $record->delete();
        flash()->success("تم الحذف بنجاح");
        return back();
    }
    public function multi_delete() {
		if (is_array(request('item'))) {
			Car::destroy(request('item'));
		} else {
			Car::find(request('item'))->delete();
		}
		session()->flash('success','تم الحذف بنجاح');
		return redirect()->back();
	}

    public function activate($id)
    {
        $user = Car::findOrFail($id);
        $user->activate = 1;
        $user->save();

        flash()->success('تم التفعيل');
        return back();
    }
    public function deactivate($id)
    {
        $user = Car::findOrFail($id);
        $user->activate = 0;
        $user->save();

        flash()->success('تم إلغاء التفعيل');
        return back();
    }
}
