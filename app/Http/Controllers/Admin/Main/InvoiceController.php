<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoices;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use App\Models\Place;
use App\Models\Trip;
use App\Models\Inplace;

use App\DataTables\InvoiceDataTable;

class InvoiceController extends Controller
{


    function __construct()
    {

         $this->middleware('permission:الفواتير', ['only' => ['index']]);
         $this->middleware('permission:اضافة فاتوره', ['only' => ['create','store']]);
         $this->middleware('permission:حذف فاتوره', ['only' => ['destroy']]);
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvoiceDataTable $invoice)
   {

        return $invoice->render('admin.invoice.index');

        // return view('layouts.main');
    }

    public function create()
    {
        return view('admin.invoice.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $rules = [
        'client_name'       => 'required',
        'phone'             => 'required|numeric',
        'types'             =>'required',
        'driver_id'         =>'required',
        'office_id'         =>'required',

        'type_id'           =>'required',
        'car_id'            =>'required',
        'fromplace'         =>'required',
        'toplace'           =>'required',
        'price'           =>'required|numeric',

 
      ];

      $messages = [
        'client_name.required'          => 'اسم العميل مطلوب',
        'phone.required'                => 'رقم التلفون مطلوب',
        'phone.numeric'                 => ' التلفون يجب ان يكون رقم',
        'price.required'                => ' سعر  الرحله مطلوب',
        'price.numeric'                 => ' سعر الرحله  يجب ان يكون رقم',
        'driver_id.required'            => 'يجب اختيار الكابتن',
        'office_id.required'            => 'يجب اختيار المكتب',

        'car_id.required'                  => 'يجب  اختيار  السياره ',
        'type_id.required'              => 'يجب اختيار الفئه',
        'fromplace.required'             => ' محطة الانطلاق  مطلوب',
        'toplace.required'                => ' محطة الوصول  مطلوبة',




      ];



      $this->validate($request, $rules, $messages);

      
          if($request->status=="go")
          {
            $status=1;
          }

          else{
            $status=0;
          }


          
          if($request->types=="out")
          {
            $types="out";
            $place=Place::where('id',$request->toplace)->first();
            $record = Trip::create([

            
              'client_name'    =>  $request->client_name,
              'phone'          =>  $request->phone,
              'driver_id'      =>  $request->driver_id,
              'office_id'      =>  $request->office_id,
              'types'          =>  "out",
              'status'         =>  'pending',
              'price'          =>  $request->price,
              'place'          =>  $place->name,
   
   
             ]);
   
           
     
     
            if($record)
            {
             $invoice= Invoices::create([
  
                  'invoice_Date'      =>   Carbon::now(),
                  'username'          =>  $request->client_name,
                  'fromplace'         =>  $request->fromplace,
                  'toplace'           =>  $place->name,
                  'driver_id'         =>  $request->driver_id,
                  'Status'            =>  'منتظره',
                  'type_id'            =>  $request->type_id,
                  'car_id'            =>  $request->car_id,
                  'Total'             =>$request->price,
                  'trip_id'           =>$record->id,
                  'place_id'           => $request->toplace,
                  'go'                => $status,
                  'office_id'      =>  $request->office_id,


  
  
              ]);
              $record->invoice_id=$invoice->id;
              $record->save();
              $place=Place::where('id',$request->toplace)->first();
              $place->count++;
              $place->save();
            }
  

          }

          else{
            $types="in";

            $record = Trip::create([

            
              'client_name'    =>  $request->client_name,
              'phone'          =>  $request->phone,
              'driver_id'      =>  $request->driver_id,
              'office_id'      =>  $request->office_id,
              'types'          =>  "in",
              'status'         =>  'pending',
              'price'          =>  $request->price,
              'place'          =>  $request->toplace,
   
   
             ]);
   
           
     
     
            if($record)
            {
             $invoice= Invoices::create([
  
                  'invoice_Date'      =>   Carbon::now(),
                  'username'          =>  $request->client_name,
                  'fromplace'         =>  $request->fromplace,
                  'toplace'           =>  $request->toplace,
                  'driver_id'         =>  $request->driver_id,
                  'Status'            =>  'منتظره',
                  'type_id'            =>  $request->type_id,
                  'car_id'            =>  $request->car_id,
                  'Total'             =>$request->price,
                  'trip_id'           =>$record->id,
                  'go'                => $status,
                  'office_id'      =>  $request->office_id,


  
  
              ]);
              $record->invoice_id=$invoice->id;
              $record->save();
              $inplace=Inplace::where('name',$request->toplace)->first();
              if($inplace==null)
                {
                  $inplace=Inplace::create([

                    'name'          => $request->toplace,
                    'count'         =>1,
                    'office_id'     =>  $request->office_id,
                    'price'         =>$request->price,



                  ]);
                }
                
              else{
                $inplace->count++;
                $inplace->save();

              }
         
            }
  

          }



       


            flash()->success("تم إضافة فاتوره بنجاح");

            return redirect(route('invoice.index'));
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


        $model = Trip::where('invoice_id',$id)->first();
        $invoice = Invoices::findOrFail($id);
        $from= $invoice->fromplace;

        $driver_trip= $model->driver_id;
        $car_trip=$invoice->car_id;
        $type_trip=$invoice->type_id;
        $status=$invoice->go;

         if($model->types=="out")
         {

          $place=Place::where('name',$invoice->toplace)->first();
          $place_id=$place->id;
          return view('admin.invoice.edit',compact('model','driver_trip','car_trip','type_trip','status','invoice','from','place_id'));

         }


         return view('admin.invoice.edit',compact('model','driver_trip','car_trip','type_trip','status','invoice','from'));





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
      $model=Trip::findorfail($id);
      $invoice=Invoices::where('trip_id',$id)->first();

      $rules = [
        'client_name'       => 'required',
        'phone'             => 'required|numeric',
        'driver_id'         =>'required',
        'office_id'         =>'required',

        'type_id'           =>'required',
        'car_id'            =>'required',
        'fromplace'         =>'required',
        'toplace'           =>'required',
        'price'           =>'required|numeric',

 
      ];

      $messages = [
        'client_name.required'          => 'اسم العميل مطلوب',
        'phone.required'                => 'رقم التلفون مطلوب',
        'phone.numeric'                 => ' التلفون يجب ان يكون رقم',
        'price.required'                => ' سعر  الرحله مطلوب',
        'price.numeric'                 => ' سعر الرحله  يجب ان يكون رقم',
        'driver_id.required'            => 'يجب اختيار الكابتن',
        'office_id.required'            => 'يجب اختيار المكتب',

        'car_id.required'                  => 'يجب  اختيار  السياره ',
        'type_id.required'              => 'يجب اختيار الفئه',
        'fromplace.required'             => ' محطة الانطلاق  مطلوب',
        'toplace.required'                => ' محطة الوصول  مطلوبة',




      ];

      $this->validate($request, $rules, $messages);

      if($request->status=="go")
      {
        $status=1;
      }

      else{
        $status=0;
      }

    
      
      if($model->types=="out")
      {
        $place=Place::where('id',$request->toplace)->first();

        $model->update([

        
          'client_name'    =>  $request->client_name,
          'phone'          =>  $request->phone,
          'driver_id'      =>  $request->driver_id,
          'office_id'      =>  $request->office_id,
          'status'         =>  $request->status,
          'price'          =>  $request->price,
          'place'          =>  $place->name,

         ]);

         $invoice->update([

              'invoice_Date'      =>   Carbon::now(),
              'username'          =>  $request->client_name,
              'fromplace'         =>  $request->fromplace,
              'toplace'           =>  $place->name,
              'driver_id'         =>  $request->driver_id,
              'Status'            =>  'منتظره',
              'type_id'            =>  $request->type_id,
              'car_id'            =>  $request->car_id,
              'Total'             =>$request->price,
              'place_id'           => $request->toplace,
              'go'                => $status,
              'office_id'      =>  $request->office_id,




          ]);
       }


      

      else{

        $record = Trip::create([

        
          'client_name'    =>  $request->client_name,
          'phone'          =>  $request->phone,
          'driver_id'      =>  $request->driver_id,
          'office_id'      =>  $request->office_id,
          'types'          =>  "in",
          'status'         =>  'pending',
          'price'          =>  $request->price,
          'place'          =>  $request->toplace,


         ]);

       
 
 
        if($record)
        {
         $invoice= Invoices::create([

              'invoice_Date'      =>   Carbon::now(),
              'username'          =>  $request->client_name,
              'fromplace'         =>  $request->fromplace,
              'toplace'           =>  $request->toplace,
              'driver_id'         =>  $request->driver_id,
              'Status'            =>  'منتظره',
              'type_id'            =>  $request->type_id,
              'car_id'            =>  $request->car_id,
              'Total'             =>$request->price,
              'trip_id'           =>$record->id,
              'go'                => $status,
              'office_id'      =>  $request->office_id,




          ]);
          $record->invoice_id=$invoice->id;
          $record->save();
          $inplace=Inplace::where('name',$request->toplace)->first();
          if($inplace==null)
            {
              $inplace=Inplace::create([

                'name'          => $request->toplace,
                'count'         =>1,
                'office_id'     =>  $request->office_id,
                'price'         =>$request->price,



              ]);
            }
            
          else{
            $inplace->count++;
            $inplace->save();

          }
     
        }


  }



   


        flash()->success("تم تعديل فاتوره بنجاح");

        return redirect(route('invoice.index'));
  }




  public function failds($id)
  
  {
      $trip = Trip::where('invoice_id',$id)->first();
      $trip->update([

        'status' => 'failed'
      ]);

      $trip->invoice()->update([

        'Status' => 'غير مدفوعة'
      ]);

      flash()->success("رحلة فاشلة");
      return redirect(route('invoice.index'));

  }

  public function succeeded($id)
  {

    $trip = Trip::where('invoice_id',$id)->first();
    $trip->update([

        'status' => 'succeeded'
      ]);

      $trip->invoice()->update([

        'Status' =>  'مدفوعه'
      ]);

      flash()->success("رحلة ناجحة");
      return redirect(route('invoice.index'));

  }

  public function destroy($id, Request $request)
  {
      $record = Invoices::findOrFail($request->invoice);
      $trip=Trip::where('invoice_id',$request->invoice)->first();  
      
      flash()->success("تم الحذف بنجاح");
      return back();
  }
  public function multi_delete() {
  if (is_array(request('item'))) {
    Invoices::destroy(request('item'));
  } 
  else {
    Invoices::find(request('item'))->delete();
  }
  session()->flash('success','تم الحذف بنجاح');
  return redirect()->back();
}

}
