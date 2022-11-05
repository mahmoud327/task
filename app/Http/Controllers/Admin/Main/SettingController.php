<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Datatables\ContactDatatable;
use App\Models\Setting;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class SettingController extends Controller
{

    function __construct()
    {

         $this->middleware('permission:الاعدادات', ['only' => ['index']]);
      

    }

    public function edit($id)
    {
        $model = Setting::findOrFail($id);
        return view('admin.settings.edit', compact('model'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'about_us'          => 'required',
            'phone'             => 'required',
            'email'             => 'required',
            'fb_link'           => 'required',
            'youtube_link'      => 'required',
            'whatsapp_link'     => 'required',
            'killo'=>'required|numeric'
        ];

        $messages = [
            'about_us.required'         => 'Name is required',
            'phone.required'            => 'phone is required',
            'email.required'            => 'email is required',
            'fb_link.required'          => 'face book link is required',
            'youtube_link.required'     => 'youtube link is required',
            'killo.required'        => 'سعر الكيلو مطلوب',
            'whatsapp_link.required'    => 'whatsapp link is required',
            'killo.numeric' => 'سعر الكيلو يجب ان يكون رقم'
        ];

        $this->validate($request, $rules, $messages);

        $record = Setting::findOrFail($id);
        $record->update($request->all());
        flash()->success("تم التعديل بنجاح");
        return back();
    }

    public function contacts(ContactDatatable $contacts)
    {

         return $contacts->render('admin.contacts.index');
    }
}
