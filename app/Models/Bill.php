<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{

    protected $table = 'bills';
    public $timestamps = true;
    protected $fillable = array('coding_type', 'bill_code','shipping_value','excluding_sum','special_marque','type_bill,'
    ,'company_name','product_name','amount_inclusive_expenses','number_of_pieces','statement','note','cost','date_bills','area_id','consignee','address','phone','phone2','special_marque','weight','total');


    public function arae(){
        return $this->belongsTo('App\Models\Area','area_id');
    }


}
