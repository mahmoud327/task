@extends('layouts.main')
@section('page_title')
التقارير الفواتير
@endsection
@push('js_exel')

@endpush

@section('content')
    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>  الفواتير </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li class="active">  التقارير الفواتير</li>
        </ol>
    </section>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- row -->
<section class="content">





    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                   <h3 class="box-title">التقارير الفواتير   </h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <div class="col-xl-12">
                        <div class="card mg-b-20">


                            <div class="card-header pb-0">

                                <form action="{{route('Searchinvoice')}}" method="POST" role="search" autocomplete="off">
                                    {{ csrf_field() }}


                                    <div class="row">

                                        <div class="col-lg-3">
                                            <label class="rdiobox">
                                                <input checked name="rdio" type="radio" value="1" id="type_div"> <span>بحث بنوع
                                                    الفاتورة</span></label>
                                        </div>

                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                            <label class="rdiobox"><input name="rdio" value="2" type="radio"><span>بحث برقم الفاتورة
                                                </span></label>
                                        </div><br><br>

                                      <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                                <p class="mg-b-10">تحديد نوع الفواتير</p>
                                                <select class="form-control select2" name="type"
                                                    required>
                                                    <option value="مدفوعه">مدفوعه </option>


                                                    <option value="غير مدفوعة"> غير مدفوعة</option>
                                                    <option value=" منتظره">  منتظره  </option>

                                                </select>
                                     </div><!-- col-4 -->


                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoice_number">
                                        <p class="mg-b-10">البحث برقم الفاتورة</p>
                                        <input type="text" class="form-control" id="invoice_number" name="invoice_number">

                                    </div>


                                        <div class="col-lg-3" id="start_at">
                                            <label for="exampleFormControlSelect1">من تاريخ</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                                    name="start_at" placeholder="YYYY-MM-DD" type="date">
                                            </div><!-- input-group -->
                                        </div>

                                        <div class="col-lg-3" id="end_at">
                                            <label for="exampleFormControlSelect1">الي تاريخ</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                </div><input class="form-control fc-datepicker" name="end_at"
                                                    value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="date">
                                            </div><!-- input-group -->
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-sm-1 col-md-1">
                                            <button class="btn btn-primary btn-block">بحث</button>
                                        </div>
                                    </div>

                               </div>

                                </form>

                            </div>
                        </div>

                        <div class="card-body" style="margin-top:5%">
                            <div class="table-responsive">
                                @if (isset($invoices))
                                     <h4>  عدد الفواتير :-{{count($invoices)}}</h4>
                                     <br>
                                     <br>
                                    <table id="tblData" class="table key-buttons text-md-nowrap" style=" text-align: center">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>

                                                <th class="border-bottom-0">رقم الفاتورة</th>
                                                <th class="border-bottom-0">تاريخ القاتورة</th>
                                                <th class="border-bottom-0">اسم الموظف </th>
                                                <th class="border-bottom-0">اسم الكابتن </th>

                                                <th class="border-bottom-0"> اسم العميل</th>
                                                <th class="border-bottom-0">محطة الانطلاق</th>
                                                <th class="border-bottom-0">محظة الوصول</th>
                                                <th class="border-bottom-0">حالة الرحلة </th>
                                                <th class="border-bottom-0">الاجمالى  </th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                         @foreach ($invoices as $invoice)
                                            <?php $i++; ?>
                                            <tr>
                                                <td>{{ $i }}</td>

                                                <td>{{ $invoice->id }} </td>
                                                <td>{{ $invoice->invoice_Date }}</td>
                                                <td>{{ $invoice->user()->first()->name }} </td>
                                                <td>{{ $invoice->driver()->first()->name }} </td>

                                                <td>{{ $invoice->username }}</td>
                                                <td>{{ $invoice->fromplace }}</td>

                                                <td>{{ $invoice->toplace }}</td>
                                                <td>{{ $invoice->Status }}</td>
                                                <td>{{ $invoice->Total }}</td>



                                            </tr>

                                        @endforeach

                                        </tbody>
                                        {!! $invoices->render() !!}


                                    </table>




                                  @endif
                            </div>
                        </div>



                </div>
             </div><!-- /.box -->

      </div><!-- /.col -->
    </div><!-- /.row -->


    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

</section>

<!-- Internal Data tables -->

@push('js')

    <script>
        <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>



    </script>






        <script>
    $(document).ready(function() {
        $('#invoice_number').hide();
        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#invoice_number').hide();
                $('#type').show();
                $('#start_at').show();
                $('#end_at').show();
            } else {
                $('#invoice_number').show();
                $('#type').hide();
                $('#start_at').hide();
                $('#end_at').hide();
            }
        });
    });
</script>

  @endpush

@endsection
