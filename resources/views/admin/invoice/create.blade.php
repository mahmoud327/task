@inject('place','App\Models\Place')
@extends('layouts.main')
@section('page_title')
اضافه فاتورة جديد
@endsection
@section('content')


    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>الفواتير </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li><a href="{{route('invoice.index')}}">  الفواتير </a></li>
            <li class="active">اضافة فاتورة</li>
        </ol>
    </section>

    <section class="content">
        <!-- row opened -->
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h4 class="card-title mg-b-0"> اضافة فاتورة</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div><!-- /.box-header -->
                <div class="box-body">

                {{-- inject Type Model --}}
                @inject('model','App\Models\Invoices')


                @include('flash::message')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($model,[
                'action' => 'Admin\Main\InvoiceController@store'
                ]) !!}

                <div class="form-group">
                    <label>  اختر المكتب</label>
                    @inject('office','App\Models\Office')
                    {!! Form::select('office_id', $office->pluck('name','id')->toArray(),null, ['class' => 'form-control','id'=>'place','placeholder'=>' اختر المكتب']) !!}

                  </div>
                <div class="form-group">
                    <label> اسم العميل</label>
                    {!! Form::text('client_name',null,[
                        'class' => 'form-control'
                    ]) !!}

                </div>
                <div class="form-group">
                    <label> رقم التليفون العيل</label>
                    {!! Form::text('phone',null,[
                        'class' => 'form-control'
                    ]) !!}

                 </div>


                <div class="form-group">
                    <label> اسم الكابتن</label>
                    @inject('driver','App\Models\Driver')
                    {!! Form::select('driver_id', $driver->pluck('name','id')->toArray(),null, ['class' => 'form-control','placeholder'=>' اخر الكابتن']) !!}

                  </div>
                    
                 <div class="form-group">
                    <label> اختر السياره </label>
                    @inject('car','App\Models\Car')
                    {!! Form::select('car_id', $car->pluck('types','id')->toArray(),null, ['class' => 'form-control','placeholder'=>' اخر السياره']) !!}

                  </div>


                 <div class="form-group">
                    <label> اختر الفئه </label>
                    @inject('type','App\Models\Type')
                    {!! Form::select('type_id', $type->pluck('name','id')->toArray(),null, ['class' => 'form-control','placeholder'=>' اخر الفئه']) !!}

                  </div>

                  <div class="form-group">
                    <label class="form-label"> اختر الرحله</label>
                    <select name="types" id="types" class="form-control  nice-select  ">
                      <option selected="selected" >اختر الرحلة</option>

                        <option  value="in"> داخل المدينه</option>
                        <option  value="out">بين المدن</option>

                    </select>

                  </div>

                  <div class="form-group">
                    <label>  محطة االانطلاق</label>
                    {!! Form::text('fromplace',null,[
                        'class' => 'form-control'
                    ]) !!}

                </div>

                <div class="form-group out">
                

                </div>

                <div class="form-group in">
               

              </div>


              <div class="form-group">
                <label class="form-label"> حالة الرحله</label>
                <select name="status" id="status" class="form-control  nice-select  custom-select">
                    <option  value="go">ذهاب</option>
                    <option  value="goandwent">ذهاب وعوده</option>

                </select>

              </div>


                  <div class="form-group">

                    <label class="form-label"> سعر الرحله </label>
                    <input class="form-control" type="number" name="price" id="price" placeholder='سعر الرحلة' >

                  </div>

                  





              


                <div class="form-group">
                <button type="submit" class="btn btn-primary"> حفظ </button>
                </div>

                {!! Form::close() !!}
                  </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->


        <!-- main-content closed -->
    </section>
    @push('js')

    <script>
      //if sort changed
      $("#types").change(function (e){
        e.preventDefault();
        var value = $("#types").val();
        console.log(value);
       if(value == "out")
       {
        $('.in').empty(); 
         $('.out').append('<label for="">  محظة الوصول</label>');
         $('.out').append('<br>');
         $('.out').append('{{ Form::select('toplace', $place->pluck('name','id')->toArray(),null,['class' => 'form-control','placeholder'=>'اختر المكان']) }}');

         // $('.card .date').append('<input class="form-control" name="deadline" type="date"   >');
    
       }
       else if(value =="in"){
        $('.out').empty(); 
        $('.in').append('<label for="">  محطة الوصول </label>');
        $('.in').append('<br>');
        $('.in').append('{{ Form::text('toplace',null,['class' => 'form-control']) }}');


       }
     
       else{
        $('.out').empty(); 
        $('.in').empty();

       }
   
  
      
      });
    </script>

@endpush

@endsection






