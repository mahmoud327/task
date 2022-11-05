{{-- <a href="{{ route('invoice.edit', $id)    }}" class="btn btn-info"> <i class="fa fa-edit"></i></a> --}}
@can('حذف فاتوره') 
  <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
  data-user_id="{{ $id }}" data-username="{{$id}}"
  data-toggle="modal" href="#modaldemo8" title="حذف"><i
      class="fa fa-trash"></i></a>~
@endcan


 <a class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale"
 data-user_id="{{ $id }}" data-username=""
 data-toggle="modal" href="#modaldemo{{$id}}" title="الفاتوره"><i
     class="">الفاتوره</i></a>
     

     @if ( App\Models\Trip::where('invoice_id',$id)->first()->status == 'pending' )

        <a href="{{ route('invoice.failds', $id)    }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
        <a href="{{ route('invoice.succeeded', $id)    }}" class="btn btn-info"> <i class="fa fa-check"></i></a>



     @elseif( App\Models\Trip::where('invoice_id',$id)->first()->status == 'succeeded' )

        تمت الرحلة
     @else
        رحلة فاشلة
     @endif




<form action="{{ route('pembayaran.print') }}" method="POST">
    @csrf
  
      <div class="modal" id="modaldemo{{$id}}">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content modal-content-demo" style="width: 270px; margin:0 auto;">
  
                  @inject("invoice", "App\Models\Invoices")
                  <div class="modal-header">
                      <h4 class="modal-title">الفاتوره</h4><button aria-label="Close" class="close"
                          data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                  </div>
  
                  <div class="modal-body" >
  
  
                      <table style="margin: 0 auto;">
  
                          <tr>
                            <th style="width: 300px"> رقم الفاتتورة</th>
                            <th> {{App\Models\Invoices::where('id',$id)->first()->id}} </th>
                          </tr>
  
  
  
                          <tr>
                            <th style="width: 300px">اسم العميل</th>
                            <th> {{App\Models\Invoices::where('id',$id)->first()->username}} </th>
                          </tr>
  
  
                          <tr>
                            <th style="width: 300px"> محطة الانطلاق</th>
                            <th> {{App\Models\Invoices::where('id',$id)->first()->fromplace}} </th>
                          </tr>
  
  
                          <tr>
                            <th style="width: 300px"> محطة الوصول</th>
                            <th> {{App\Models\Invoices::where('id',$id)->first()->toplace}} </th>
                          </tr>
  
  
                          <tr>
                            <th style="width: 300px">  اسم الكابتن</th>
                            <th> {{App\Models\Invoices::where('id',$id)->first()->driver()->first()->name}} </th>
                          </tr>
  
  
                        </table>
  
                          --------------------------------------------------
  
  
                          <table>
                              <tr>
                                  <th style="width: 300px">نوع السيارة</th>
                                  <th style="width: 300px">رقم اللوحة</th>
                                  <th style="width: 300px">الفئة</th>
                              </tr>
  
                              <tr>
                                  <td> {{App\Models\Invoices::where('id',$id)->first()->car()->first()->types}} </td>
                                  <td> {{App\Models\Invoices::where('id',$id)->first()->car()->first()->plate}} </td>
                                  <td> {{App\Models\Invoices::where('id',$id)->first()->type()->first()->name}} </td>
                              </tr>
  
                          </table>
  
  
                          <table style="margin: 50px auto; ">
                              <tr >
                                  <th>الاجمالي</th>
                                  <th> {{App\Models\Invoices::where('id',$id)->first()->Total}} </th>
                              </tr>
                          </table>
  
  
                          <button type="submit" name="submit" class="btn btn-primary">طباعة</button>
  
                  </div>
  
          </div>
      </div>
  
  
  
  </form>
  