<?php

namespace App\Http\Controllers\Admin\Main;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Invoices;
use App\Models\Driver;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ReportInvoiceContoller extends Controller
{

   function __construct()
   {

        $this->middleware('permission:تقارير الفواتير', ['only' => ['index']]);
      
   }

    public function index(){

      $office = Office::all();
      return view('admin.reports.invoice_reports',compact('office'));
        
    }



  public function Search_invoice(Request $request){


    $rdio = $request->rdio;


// في حالة البحث بنوع الفاتورة
   
   if ($rdio == 1) {
      
      
// في حالة عدم تحديد تاريخ
      if ($request->type && $request->start_at =='' && $request->end_at =='') {
         
         $invoices = invoices::select('*')->where('Status','=',$request->type)->paginate(2);
         $type = $request->type;
         $invoices->setPath('Search_invoice');

         return view('admin.reports.invoice_reports',compact('type','invoices'));
      }
      
       // في حالة تحديد تاريخ استحقاق
      else {
         
      $start_at = date($request->start_at);
      $end_at = date($request->end_at);
      $type = $request->type;
      
      $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->paginate(2);
         return view('admin.reports.invoice_reports',compact('invoices'));
      
      }


      
   } 
   
//====================================================================
   
// في البحث برقم الفاتورة
else {
      
      $invoices = invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
      return view('admin.reports.invoice_reports',compact('invoices'));
      
     } 

   
    
   }
   
 }
