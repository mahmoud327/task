<?php

namespace App\Http\Controllers\User\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\User\TripDatatable;
use App\Models\Driver;
use App\Models\Trip;
use App\Models\Invoices;
use Carbon\Carbon;
use App\Models\Place;
use Auth;

class OutsideTripController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $trips = new TripDatatable($id);
        return $trips->render('user.outsidetrip.index');
    }

    public function create()
    {

        $drivers = Driver::where('id', auth()->user()->office_id)->get();
        // $selectedID = Office::first();
        return view('user.outsidetrip.fixed', compact('drivers'));
    }


    public function store(Request $request)
    {


         $rules = [
            'client_name'       => 'required',
            'phone'             => 'required|numeric',
            'address'           =>'required',
            'place_id'          =>'required',
            'types'             =>'required',
            'driver_id'         =>'required',
            'type_id'         =>'required',
            'car_id'         =>'required',


            'discount_per'      =>'max:'.Auth::user()->discount_per
          ];

          $messages = [
            'client_name.required'          => 'اسم العميل مطلوب',

            'address.required'              => ' العنوان مطلوب',

            'phone.required'                => 'رقم التلفون مطلوب',
            'phone.numeric'                 => ' التلفون يجب ان يكون رقم',


            'driver_id.required'            => 'يجب اختيار الكابتن',
            'car_id.required'                  => 'يجب  اختيار  السياره ',

            'type_id.required'              => 'يجب اختيار الفئه',


            'discount_per.max'              => Auth::user()->discount_per . 'يجب الا تزيد نسبة الخصم عن ',

            'place_id.required'             => ' مكان الرحله مطلوب',

            'types.required'                => ' حالة الرحله مطلوبة',




          ];



          $this->validate($request, $rules, $messages);

          $place=Place::where('id',$request->place_id)->first();


          if($request->price_after_dec != null)
          {
            $price = $request->price_after_dec;
          }
          else
          {
            $price = $request->price;
          }

          if($request->types=="go")
          {
            $status=1;
          }

          else{
            $status=0;
          }



          $record = Trip::create([

           'user_id'        =>  auth()->user()->id,
           'office_id'      =>  auth()->user()->office_id,
           'client_name'    =>  $request->client_name,
           'address'        =>  $request->address,
           'phone'          =>  $request->phone,
           'driver_id'      =>  $request->driver_id,
           'types'          =>  "out",
           'status'         =>  'pending',
           'price'          =>  $price,
           'place'          =>  $place->name,


          ]);


          if($record)
          {
           $invoice= Invoices::create([

                'invoice_Date'      =>   Carbon::now(),
                'username'          =>  $request->client_name,
                'fromplace'         =>  auth()->user()->office()->first()->name,
                'place_id'          =>$request->place_id,
                'toplace'           =>  $place->name,
                'driver_id'         =>  $request->driver_id,
                'Status'            =>  'منتظره',
                'user_id'           =>  auth()->user()->id,
                'office_id'         =>  auth()->user()->office_id,
                'type_id'            =>  $request->type_id,
                'car_id'            =>  $request->car_id,
                'Total'             =>  $price,
                'branch'            => auth()->user()->office()->first()->name,
                'trip_id'           =>$record->id,
                'discount_per'       =>$request->discount_per,
                'go'                 =>$status


            ]);
            $record->invoice_id=$invoice->id;
            $record->save();
            $place=Place::where('office_id',auth()->user()->office_id)->where('id',$request->place_id)->first();
            $place->count++;
            $place->save();
          }

          flash()->success("تم إضافة رحلة بنجاح");



          return redirect(route('user-trips.index'));


    }

    public function getplaces(Request $request){

        $place = Place::where('id',$request->place_id)->get();
        if(count($place))
        {
          $response    = [
           'status'  => 1,
           'message' =>'success',
           'data'    => $place
         ];
         return response()->json($response);
        }

        else {
          $response    = [
           'status'  => 0,
           'message' =>'fals',

         ];
         return response()->json($response);
        }

    }



    public function edit($id)
    {


        $model = Trip::findOrFail($id);

       $place1=$model->place;
       $selected=Place::where('name',$place1)->first();

       $selectedId= $selected->id;

        return view('user.outsidetrip.edit',compact('model','selectedId'));
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

      $rules = [
        'client_name' => 'required',
        'phone' => 'required|numeric',
        'address'    =>'required',
        'place_id'   =>'required',
        'types'     =>'required',
        'driver_id' =>'required'
      ];

      $messages = [
        'client_name.required'  => 'اسم العميل مطلوب',
        'address.required'     => ' العنوان مطلوب',

        'phone.required'      => 'رقم التلفون مطلوب',

        'phone.numeric'        => ' التلفون يجب ان يكون رقم',


        'driver_id.required'      => 'يجب اختيار الكابتن',

        'place_id.required' => ' مكان الرحله مطلوب',
        'types.required' => ' حالة الرحله مطلوب',




      ];


      $this->validate($request, $rules, $messages);

      $place=Place::where('id',$request->place_id)->first();

      if($request->types=="goandwent")
      {

        $model->update([

          'user_id'       =>auth()->user()->id,
          'office_id'     =>auth()->user()->office_id,
           'client_name'  =>$request->client_name,
           'address'      =>$request->address,
           'phone'        =>$request->phone,
           'driver_id'    =>$request->driver_id,
           'types'        =>"out",
           'status'       =>$request->status,
           'price'        =>$place->price2,
           'place'        =>$place->name



          ]);
          $model->save();

          flash()->success("تم تعديل رحلة بنجاح");

          return redirect(route('user-trips.index'));
      }

      if($request->types=="go"){

        $model->update([

        'user_id'       =>auth()->user()->id,
        'office_id'     =>auth()->user()->office_id,
        'client_name'  =>$request->client_name,
        'address'      =>$request->address,
        'phone'        =>$request->phone,
        'driver_id'    =>$request->driver_id,
        'types'        =>"out",
        'status'       =>$request->status,
        'price'        =>$place->price,
        'place'        =>$place->name




        ]);
          $model->save();

      flash()->success("تم تعديل رحلة بنجاح");

      return redirect(route('user-trips.index'));
    }
  }




  public function failds($id)
  {
      $trip = Trip::find($id);
      $trip->update([

        'status' => 'failed'
      ]);

      $trip->invoice()->update([

        'Status' => 'غير مدفوعة'
      ]);

      flash()->success("رحلة فاشلة");
      return redirect(route('user-trips.index'));

  }

  public function succeeded($id)
  {
      $trip = Trip::find($id);
      $trip->update([

        'status' => 'succeeded'
      ]);

      $trip->invoice()->update([

        'Status' =>  'مدفوعه'
      ]);

      flash()->success("رحلة ناجحة");
      return redirect(route('user-trips.index'));

  }

}
