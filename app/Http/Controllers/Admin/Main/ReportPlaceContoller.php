<?php

namespace App\Http\Controllers\Admin\Main;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Invoices;
use App\Models\Place;
use App\Models\Inplace;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ReportPlaceContoller extends Controller
{

   function __construct()
   {

        $this->middleware('permission:تقارير الواجهات', ['only' => ['index']]);
      
   }

    public function index(){

      $office = Office::all();
      return view('admin.reports.place_reports',compact('office'));
        
    }



    public function Search_place(Request $request){


    
      $rdio = $request->rdio;


      // في حالة البحث بنوع الفاتورة
         
         if ($rdio == 1) 
         {
           
        
                
          // في حالة عدم تحديد تاريخ
                if ($request->place_id&&$request->office_id  && $request->start_at =='' && $request->end_at =='') 
                {
        
                        
                    $places = Place::select('*')->where('office_id',$request->office_id)->where('id',$request->place_id)->get();

                    return view('admin.reports.place_reports',compact('places'));
                
                }
                
                // في حالة تحديد تاريخ استحقاق
                else 
                {

  
                            
                      $start_at = date($request->start_at);
                      $end_at = date($request->end_at);
                      $office = $request->office_id;
                      
                      $places = Place::whereBetween('created_at',[$start_at,$end_at])->where('office_id',$request->office_id)->where('id',$request->place_id)->get();
                      return view('admin.reports.place_reports',compact('places'));

                }
        
      
            
            } 
         
      //====================================================================
         
       // في البحث  كل 
       else
        {
              if($request->types=="out")
              {
                $places = Place::where('office_id',$request->office_id)->orderBy('count', 'DESC')->get();
                return view('admin.reports.place_reports',compact('places'));
                    
              } 

              else
              {
                $places = Inplace::where('office_id',$request->office_id)->orderBy('count', 'DESC')->get();
                return view('admin.reports.place_reports',compact('places'));
                    
              }
         }
      
         
          
     }
   
   public function getplaces(Request $request){

      $place = Place::where('office_id',$request->office)->get();
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
   
 }
