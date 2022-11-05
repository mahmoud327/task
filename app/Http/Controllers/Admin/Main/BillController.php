<?php

namespace App\Http\Controllers\Admin\Main;

use App\DataTables\AreaDataTable;
use App\DataTables\BillDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BillReuquest;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Support\Str;




class BillController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BillDataTable $bill)
   {

        return $bill->render('admin.bills.index');

        // return view('layouts.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $areas= Area::get();
        return view('admin.bills.create',compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillReuquest $request)
    {
        if(!$request->date_bills){
            $request['date_bills']=Carbon::now();
        }
        $bill = Bill::create($request->all());
        $code='SE0'.$bill->id.'0';
        $bill-> bill_code= $code;
        $bill->save();

          flash()->success("تم إضافة البوليصه بنجاح");
          return redirect(route('bill.print',$bill->id));
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

    public function print($id){
      $bill= Bill::find($id);
      return view('admin.bills.print',compact('bill'));

    }
    public function billArea(Request $request){

      return response()->json(Area::find($request->area_id));
    }

}
