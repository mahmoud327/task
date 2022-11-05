<?php

namespace App\Http\Controllers\User\Main;
use App\Http\Controllers\Controller;
use App\DataTables\User\TripDatatable;
use App\DataTables\User\TripinDatatable;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Trip;
use App\Models\Setting;
use App\Models\Type;
use App\Models\Inplace;
use App\Models\Invoices;
use Carbon\Carbon;




use Auth;

class InsideTripController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $id = Auth::user()->id;
        $trips = new TripinDatatable($id);
        return $trips->render('user.insidetrip.index');
    }

    public function create()
    {

        $drivers = Driver::where('id', auth()->user()->office_id)->get();
        // $selectedID = Office::first();
        return view('user.insidetrip.create', compact('drivers'));
    }

    public function store(Request $request)
    {
    
        $rules = [
            'client_name'       => 'required',
            'phone'             => 'required|numeric',
            'address'           =>'required',
            'types'             =>'required',
          
            'toplace'           =>'required',
            'driver_id'         =>'required',
            'type_id'         =>'required',
            'car_id'         =>'required',

          ];

          $messages = [
            'client_name.required'  => 'اسم العميل مطلوب',
            'address.required'      => ' العنوان مطلوب',
            'types.required'        => ' حالة الرحله مطلوب',
            'phone.required'                => 'رقم التلفون مطلوب',
            'phone.numeric'                 => ' التلفون يجب ان يكون رقم',
            'driver_id.required'            => 'يجب اختيار الكابتن',
            'car_id.required'                  => 'يجب  اختيار  السياره ',
            'type_id.required'              => 'يجب اختيار الفئه',
            'toplace.required'              => ' محطة الوصول مطلوبه',


            


          ];

          $this->validate($request, $rules, $messages);

      

           $type=Type::where('id',$request->type_id)->first();
           $setting=Setting::first();
           
           if($request->types=="go")
           {
                $status=1;
                
                if($request->discount_per != null)
                {
                    $price=$type->price * $request->distance * $setting->killo;

                    $price_total=$price-($price *($request->discount_per/100));

                }

                else
                {
                    $price_total=$type->price * $request->distance * $setting->killo;
                }

           }  
    

      
           else
           {
             $status=0;
               
             if($request->discount_per != null)
             {
                 $price=($type->price * $request->distance * $setting->killo) * 2 ;

                 $price_total=$price-($price *($request->discount_per/100));

             }

             else
             {
                 $price_total=($type->price * $request->distance * $setting->killo) * 2;
             } 

           }
           
 
             

           
 
          $record = Trip::create([

            'user_id'        =>  auth()->user()->id,
            'office_id'      =>  auth()->user()->office_id,
            'client_name'    =>  $request->client_name,
            'address'        =>  $request->address,
            'phone'          =>  $request->phone,
            'driver_id'      =>  $request->driver_id,
            'types'          =>  "in",
            'status'         =>  'pending',
            'price'          =>  $price_total,
            'place'          =>  $request->toplace,

 
 
           ]);
 
 
           if($record)
           {
            $invoice= Invoices::create([
 
                 'invoice_Date'      =>   Carbon::now(),
                 'username'          =>  $request->client_name,
                 'fromplace'         =>  auth()->user()->office()->first()->name,
                 'toplace'           =>  $request->toplace,
                 'driver_id'         =>  $request->driver_id,
                 'Status'            =>  'منتظره',
                 'user_id'           =>  auth()->user()->id,
                 'office_id'         =>  auth()->user()->office_id,
                 'type_id'            =>  $request->type_id,
                 'car_id'            =>  $request->car_id,
                 'Total'             =>  $price_total,
                 'branch'            => auth()->user()->office()->first()->name,
                 'trip_id'           =>$record->id,
                 'discount_per'       =>$request->discount_per,
                 'go'                 =>$status
 
 
             ]);
             $record->invoice_id=$invoice->id;
             $record->save();
             $inplace=Inplace::where('name',$request->toplace)->first();
             if($inplace==null)
               {
                 $inplace=Inplace::create([
   
                   'name'          => $request->toplace,
                   'count'         =>1,
                   'office_id'         =>  auth()->user()->office_id,
                   'price'         =>$price_total,
   
   
   
                 ]);
               }
               
             else{
               $inplace->count++;
               $inplace->save();
   
             }
           }
 
           flash()->success("تم إضافة رحلة بنجاح");
 
 
 
           return redirect(route('inside_city.index'));
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
      return redirect(route('inside_city.index'));

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
      return redirect(route('inside_city.index'));

  }
  


}
