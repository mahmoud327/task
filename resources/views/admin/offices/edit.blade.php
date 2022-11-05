@extends('layouts.main')
@section('page_title')
تعديل مكتب
@endsection

@section('css')

@endsection

@section('content')


    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>تعديل مكتب</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li><a href="{{route('office.index')}}">  المكاتب </a></li>
            <li class="active">تعديل مكتب</li>
        </ol>
    </section>




    <section class="content">
        <!-- row opened -->
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h4 class="card-title mg-b-0"> تعديل مكتب</h4>
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
                    @include('flash::message')
                    <div class="col-lg-12 margin-tb">
                       <div class="pull-right">
                           <a class="btn btn-primary btn-sm" href="{{ route('office.index') }}">رجوع</a>
                       </div>
                   </div><br>

                   {!! Form::model($office, ['method' => 'PATCH','route' => ['office.update', $office->id]]) !!}
                   <div class="">

                       <div class="row mg-b-20">
                           <div class="parsley-input col-md-6" id="fnWrapper">
                               <label>اسم المكتب: <span class="tx-danger">*</span></label>
                               {!! Form::text('name', null, array('class' => 'form-control','required')) !!}
                           </div>

                           <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                               <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                               {!! Form::text('email', null, array('class' => 'form-control','required')) !!}
                           </div>

                       </div>

                   </div>

                   <div class="row mg-b-20">


                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>الهاتف: <span class="tx-danger">*</span></label>
                            {!! Form::text('phone', null, array('class' => 'form-control','required')) !!}
                        </div>


                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0">

                            <label>العنوان: <span class="tx-danger">*</span></label>
                            {!! Form::text('address', null, array('class' => 'form-control','required')) !!}
                        </div>

                    </div>



                        <div id="other_data" class="tab-pane ">
                            <h3 class="text-center" style="padding-top: 50px"> البلاد المتاح السفر اليها من هذا المكتب </h3>
                            <hr>
                            <div class="div_inputs ">
                                @foreach ($office->places()->get() as $place)
                                <div>
                                    <div class="col-md-6">
                                        {!! Form::label('title','الواجهة ' )!!} {{$loop->iteration}}
                                        {!! Form::text('title[]',$place->name,['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('price','سعر الذهاب') !!}
                                        {!! Form::number('price[]',$place->price,['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>

                                    <div class="col-md-6">
                                        {!! Form::label('price2','سعر ذهاب وعوده') !!}
                                        {!! Form::number('price2[]',$place->price,['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                    <a href="#" class="remove_input btn btn-danger"><i class="fa fa-trash"></i></a>
                                </div>

                                @endforeach
                            </div>

                            <div class="clearfix"></div>
                            <br>
                            <a href="#" class="add_input btn btn-info"><i class="fa fa-plus"></i></a>
                            <div class="clearfix"></div>
                            <br>
                        </div>


                   <div class="mg-t-30">
                       <button class="btn btn-primary" type="submit">تحديث</button>
                   </div>
                   {!! Form::close() !!}
                  </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->


        <!-- main-content closed -->
    </section>



@endsection

@push('js')
<script type="text/javascript">
    var x= {{$office->places()->count()}} + 1;
      $(document).on('click','.add_input',function(e){
              e.preventDefault();

              $('.div_inputs').append('<div>'+
                  '<div class="col-md-6">'+

                      '{!! Form::label('title',  ' الواجهة ' )!!} '+ x +
                      '{!! Form::text('title[]',null,['class'=>'form-control', 'required' => 'required']) !!}'+
                  '</div>'+
                  '<div class="col-md-6">'+


                      '{!! Form::label('price',' سعر الذهاب ') !!}'+
                      '{!! Form::number('price[]',null,['class'=>'form-control', 'required' => 'required']) !!}'+
                  '</div>'+

                  '<div class="col-md-6">'+
                    '{!! Form::label('price2',' سعر ذهاب وعوده ') !!}'+
                    '{!! Form::number('price2[]',null,['class'=>'form-control', 'required' => 'required']) !!}'+
                    '</div>'+
                  '<div class="clearfix"></div>'+
                  '<br>'+
                  '<a href="#" class="remove_input btn btn-danger"><i class="fa fa-trash"></i></a>'+
              '</div>');
              x++;

      });
      $(document).on('click','.remove_input',function(){
          $(this).parent('div').remove();
          x--;
          return false;
      });
      </script>
@endpush
