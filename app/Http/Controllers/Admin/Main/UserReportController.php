<?php

namespace App\Http\Controllers\Admin\Main;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Invoices;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserReportController extends Controller
{

  function __construct()
  {

       $this->middleware('permission:تقارير الموظفين', ['only' => ['index']]);
     
  }

    public function index(){

      $office = Office::all();
      return view('admin.reports.user_reports',compact('office'));
        
    }


    public function Search_users(Request $request){




// في حالة البحث بدون التاريخ
      
     if ($request->office_id && $request->user_id && $request->start_at =='' && $request->end_at=='') {

       
      $invoices = Invoices::select('*')->where('office_id','=',$request->office_id)->where('user_id','=',$request->user_id)->get();
       return view('admin.reports.user_reports',compact('invoices'));
       ;

    
     }


  // في حالة البحث بتاريخ
     
     else {
       
       $start_at = date($request->start_at);
       $end_at = date($request->end_at);

      $invoices = Invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('office_id','=',$request->office_id)->where('user_id','=',$request->user_id)->get();
      
       $office = Office::all();
       return view('admin.reports.user_reports',compact('invoices'));

      
     }
     
  
    
    }
    public function  getuser(Request $request)
    {
        $user = User::where('office_id',$request->office)->get();
        if(count($user))
        {
          $response    = [
           'status'  => 1,
           'message' =>'success',
           'data'    => $user
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
}