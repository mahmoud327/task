@extends('layouts.main')
@section('page_title')
    اضافه بوليصه جديد
@endsection


@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        *{
            font-family: auto !important;
        }
        input[type=checkbox],
        input[type=radio] {
            margin: 3px;

        }

        .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            height: 28px !important;
        }

        input,
        select {
            height: 28px !important;
            border: 1px solid rgb(182, 169, 169);
            border-radius: 10px;

        }

        .input-group {
            padding: 0;
        }
    </style>
@endsection

@section('content')

    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>البوليصه </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li><a href="{{ route('bills.index') }}"> البوليصه </a></li>
            <li class="active">اضافة بوليصه</li>
        </ol>
    </section>
<form action="{{ route('bills.store') }}" method="post">
    @csrf

    <div class="container ">
        <h6 class="text-center fs-3 p-3">بيانات البوليصه </h6>

        <div class="row box border m-0 p-5  ">

            <div class="col-md-6 input-group mb-3 w-50 ">
                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01"> نوع التكويد</label>
                <div class=" ">

                    <label class="rdiobox ">
                        <input checked name="coding_type" type="radio" value="manual" id="personal"> <span>يدوى
                        </span>
                    </label>

                    <label class="rdiobox"><input name="coding_type" id="company" value="automatic" type="radio">
                        <span>
                            اتوماتيك
                        </span>
                    </label>
                </div>

            </div>

            <div class="col-md-6 input-group mb-3 w-50 ">
                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01"> نوع البوليصه</label>

                <select class="js-example-basic-multiple w-50" required name="type_bill" id="inputGroupSelect01">
                    <option value="1">مبلغ مقابل طرد</option>
                    <option value="2">طرد مقابل طرد</option>
                    <option value="3">طرد بدوو مقابل</option>
                </select>

            </div>


            {{-- <div class="col-md-6 input-group mb-3 w-50  ">
                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01">نوع العملية</label>

                <input type="text" class="rounded-2 w-75">

            </div> --}}
            <div class="input-group mb-3  w-50 ">
                <span class="input-group-text bg-primary text-white" id="basic-addon2"> اسم المنتج </span>
                <input type="text" class="form-control" name="product_name"placeholder="اسم المنتج" min="0"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3  w-50 ">
                <span class="input-group-text bg-primary text-white" id="basic-addon2">عدد القطع </span>
                <input type="number" class="form-control" name="number_of_pieces"placeholder="عدد القطع" min="0"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3  w-50 ">
                <span class="input-group-text bg-primary text-white" id="basic-addon2">تاريخ </span>
                <input type="date" class="form-control" name="date_bills" placeholder="uto" aria-label="Recipient's username"
                    aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3  w-25 ">
                <span class="input-group-text bg-primary text-white" id="basic-addon2">السعر </span>
                <input type="text" class="form-control" name="cost" placeholder="السعر" aria-label="Recipient's username"
                    aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3  w-25 ">
                <span class="input-group-text bg-primary text-white" id="basic-addon2">الوزن </span>
                <input type="text" class="form-control" name="weight" placeholder="الوزن"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3  w-50 ">
                <span class="input-group-text bg-primary text-white" id="basic-addon2">البيان </span>
                <input type="text" class="form-control" name="statement" placeholder="البيان"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>

            <div class="input-group  mb-3">
                <span style="height: auto !important" class="input-group-text bg-primary text-white" id="basic-addon2">وصف
                </span>
                <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div class="container ">
        <h6 class="text-center fs-3 p-3">بيانات المرسل اليه </h6>

        <div class="row box border m-0 p-5  ">

            <div class="col-md-6 input-group mb-3 w-50 ">
                <label class="input-group-text bg-primary text-white"   for="inputGroupSelect01"> اسم المرسل اليه</label>

                <input type="text" naem="consignee"class="rounded-2 w-75" name="consignee">


            </div>


            <div class="col-md-6 input-group mb-3 w-50 ">
                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01"> اختر المنطقه</label>
                <select name="area_id" class="js-example-basic-multiple" id=area style="width: 80%">
                    <option >اختر المنطقه</option>
                    @foreach ($areas as $area)
                        <option onlyslave="True" value="{{ $area->id }}">
                            {{ $area->area_name }}
                        </option>
                    @endforeach
                </select>

            </div>


            <div class="col-md-6 input-group mb-3 w-50  ">
                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01">العنوان </label>

                <input type="text" name="address"class="rounded-2 w-75">

            </div>
            <div class="input-group mb-3  w-50 ">
                <span class="input-group-text bg-primary text-white" id="basic-addon2">علامة مميزه </span>
                <input type="text" class="form-control" name="special_marque"placeholder="علامه مميزه"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3  w-50 ">
                <span class="input-group-text bg-primary text-white" id="basic-addon2" >رقم التليفون </span>
                <input type="text" class="form-control" name="phone"placeholder="رقم التليفون "
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3  w-25 ">
                <span class="input-group-text bg-primary text-white" id="basic-addon2">رقم تليفون اخر </span>
                <input type="text" class="form-control" name="phone2"placeholder="رقم تليفون اخر"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>

        </div>
    </div>
    <div class="container ">
        <h6 class="text-center fs-3 p-3">بيانات العميل </h6>

        <div class="row box border m-0 p-5  ">

            <div class="col-md-6 input-group mb-3 w-50 ">
                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01"> اسم الشركه </label>

                <input type="text" name="company_name"  value="Spead Era" class="rounded-2 w-75">


            </div>


            <div class="col-md-6 input-group mb-3 w-50 ">
                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01"> مبلغ شامل المصاريف</label>
                <input type="text" namr="amount_inclusive_expenses" id="expenses"class="rounded-2 w-75">


            </div>


            <div class="col-md-6 input-group mb-3 w-50  ">
                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01"> مبلغ غير شامل
                    المصاريف</label>
                <input type="text" name="excluding_sum" id="excluding_sum"class="rounded-2 w-75">
            </div>
            <div class="input-group mb-3  w-50 ">
                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01"> قيمة الشحن</label>
                <input type="text" name="shipping_value" id="shipping_value"class="rounded-2 w-75">
            </div>
            <div class="input-group mb-3  w-50 ">
                <label class="input-group-text bg-primary text-white" for="inputGroupSelect01"> الصافى</label>
                <input type="text" name="total" id="total"class="rounded-2 w-75">
            </div>


            <div class="text-center">
                <button class="btn btn-primary" type="submit" > submit</button>
            </div>
        </div>
    </div>

</form>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>


    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();


            $('.organization').select2();

            $('.organization').select2({
                closeOnSelect: false

            });

        });
        $('#expenses').on('keyup',function(){
            $('#excluding_sum').empty();
            $('#total').empty();
           var expenses= $(this).val();
           var shipping_value=$('#shipping_value').val();
            $('#total').val(expenses -shipping_value );
        });

        $('#excluding_sum').on('keyup',function(){
            $('#expenses').empty();
            $('#excluding_sum').empty();


           var excluding_sum= $(this).val();
           var shipping_value=$('#shipping_value').val();

            $('#total').val( Number(excluding_sum) + Number(shipping_value) );
        });
    </script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\BillReuquest') !!}

    <script>
        //if governorates changed
        $("#area").change(function (e){

          e.preventDefault();
          // get gov
          var area_id = $("#area").val();
          //console.log(g);
          if(area_id)
          {
            $('#shipping_value').empty();
            $('#expenses').empty();
            $('#excluding_sum').empty();
            $.ajax({
              url      : "{{route('bill.area')}}",
              data:{
                'area_id':area_id
              },
              type     : 'get',
              success  : function (data) {
                // if(data.status == 1)
                // {
                   $('#shipping_value').val(data.cost);

              },
              error : function (jqXhr, textStatus, errorMessage){
                alert(errorMessage);
              }
            });
          }
          else
          {
            $('#shipping_value').empty();
            $('#expenses').empty();
            $('#excluding_sum').empty();
          }
        });
      </script>

@endpush
