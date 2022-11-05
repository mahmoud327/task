@extends('layouts.main')
@section('page_title')
تعديل  فاتوره 
@endsection

@section('css')

@endsection

@section('content')


    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>تعديل فاتوره  </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li><a href="{{route('invoice.index')}}"> الفواتير </a></li>
            <li class="active">تعديل   فاتوره</li>
        </ol>
    </section>




    <section class="content">
        <!-- row opened -->
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h4 class="card-title mg-b-0"> تعديل   فاتوره</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div><!-- /.box-header -->
                <div class="box-body">
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
                        'action' => ['Admin\Main\InvoiceController@update', $model->id],
                        'method' => 'put'
                        ]) !!}

                          <div class="form-group">
                            <label>  اختر المكتب</label>
                            @inject('office','App\Models\Office')
                            {!! Form::select('office_id', $office->pluck('name','id')->toArray(),$model->office_id, ['class' => 'form-control','id'=>'place','placeholder'=>' اختر المكتب']) !!}

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
                            {!! Form::select('driver_id', $driver->where('activate',1)->pluck('name','id')->toArray(),$driver_trip,  ['class' => 'form-control','placeholder'=>' اخر الكابتن']) !!}

                          </div>




                            <div class="form-group">
                                <label> اختر الفئه </label>
                                @inject('type','App\Models\Type')
                                {!! Form::select('type_id', $type->pluck('name','id')->toArray(),$type_trip, ['class' => 'form-control','placeholder'=>' اخر الفئه']) !!}

                            </div>


                            <div class="form-group">
                                <label> اختر السياره </label>
                                @inject('car','App\Models\Car')
                                {!! Form::select('car_id', $car->pluck('types','id')->toArray(),$car_trip, ['class' => 'form-control','placeholder'=>' اخر الفئه']) !!}

                            </div>

                            {{-- <div class="form-group">
                              <label> محطة الانطلاق</label>
                              @inject('place','App\Models\place')
                              {!! Form::select('place_id', $place->pluck('name','id')->toArray(),$invoice->fromplace,['class' => 'form-control','id'=>'place','placeholder'=>' اختر المكان']) !!}

                            </div> --}}

                            <div class="form-group">
                              <label>  محطة الانطلاق</label>
                              <input class="form-control" name="fromplace"placeholder='محطة الامطلاق'  value="{{$from}}">

  
                           </div>
                           @if($model->types == "out")
                            <div class="form-group">
                              <label> محطة الوصول</label>
                              @inject('place','App\Models\place')
                              {!! Form::select('toplace', $place->pluck('name','id')->toArray(),$place_id, ['class' => 'form-control','id'=>'place','placeholder'=>' اختر المكان']) !!}

                            </div>

                            @else
                            <div class="form-group">
                              <label>  محطة الوصول</label>
                              <input class="form-control" name="fromplace"placeholder='محطة الوصول'  value="{{$invoice->toplace}}">

  
                           </div>

                          @endif

       
                           


                            <div class="form-group">
                              <label class="form-label"> حالة الرحله</label>
                              <select name="types" id="status" class="form-control  nice-select  custom-select">
                                  <option @if ($status)
                                      selected
                                  @endif value="go" > >ذهاب</option>
                                  <option  @if (!$status)
                                    selected
                              @endif value="goandwent">ذهاب وعوده</option>
          
                              </select>
          
                            </div>
          
                           


                          <div class="form-group">
                            <label class="form-label"> سعر الرحله</label>
                            <div class="form-group">
                                {!! Form::text('price',null,[
                                'class' => 'form-control', 'placeholder'=>'سعر الرحلة',
                                 'id'=>'price',
                                ]) !!}
                              </div>
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
        //if places changed
        $("#place").change(function (e){
          e.preventDefault();

          // get gov
          var place_id = $("#place").val();
          var status= $("#status").val();

          if(place_id)
          {
            $.ajax({
              url      : '{{url('places?place_id=')}}'+place_id,
              type     : 'get',
              success  : function (data) {
                if(data.status == 1)
                {
                    if(status=="go")
                    {
                        $("#price").val('');
                       $.each(data.data, function(index,price){
                        $("#price").val(price.price);
                        });
                    }

                    if(status=="goandwent")
                    {
                        $("#price").val('');
                        $.each(data.data, function(index,price){
                            $("#price").val(price.price2);
                        });
                    }

                }
              },
              error : function (jqXhr, textStatus, errorMessage){
                alert(errorMessage);
              }
            });
          }
          else
            {
                $("#price").val('');
            }

        });


        $("#status").change(function (e){
          e.preventDefault();
          var status= $("#status").val();
          

          // get gov
          var place_id = $("#place").val();
       

          if(place_id)
          {

            $.ajax({
              url      : '{{url('places?place_id=')}}'+place_id,
              type     : 'get',
              success  : function (data) {
                if(data.status == 1)
                {
                  
                    if(status=="go")
                    {
                        $("#price").val('');
                       $.each(data.data, function(index,price){
                        $("#price").val(price.price);
                        });
                    }

                    if(status=="goandwent")
                    {
                        $("#price").val('');
                        $.each(data.data, function(index,price){
                            $("#price").val(price.price2);
                        });
                    }

                }
              },
              error : function (jqXhr, textStatus, errorMessage){
                alert(errorMessage);
              }
            });
          }
          else
            {
                $("#price").val('');
            }

        });





      </script>

     
@endpush

@endsection

