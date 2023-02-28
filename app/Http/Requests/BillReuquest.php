<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillReuquest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules() {
        return[
            // 'excluding_sum'=>'required|integer',
            // 'special_marque'=>'required',
            // 'excluding_sum'=>'required|integer',
            // 'date_bills'=>'required|date',
            // 'company_name'=>'required',
            // 'weight'=>'required',
            // 'number_of_pieces'=>'required|numeric',
            // 'amount_inclusive_expenses'=>'required|numeric',
            // 'shipping_value'=>'required|numeric',
            // 'cost'=>'required|numeric',
            'consignee'=>'required',
            'area_id'=>'required|numeric',
            'address'=>'required',
            'phone'=>'required'
        ];
    }
}
