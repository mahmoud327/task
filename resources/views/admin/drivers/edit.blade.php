@extends('layouts.main')
@section('page_title')
  بيانات الكابتن
@endsection
@section('content')

<section class="content-header">
    <h1>
        لوحة التحكم
        <small>تعديل بيانات الكابتن </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li><a href="{{route('driver.index')}}">  الكباتن  </a></li>
        <li class="active">تعديل    بيانات الكابتن</li>
    </ol>
</section>

<section class="content">
    <!-- row opened -->
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h4 class="card-title mg-b-0"> تعديل  بيانات الكابتن</h4>
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
              'action' => ['Admin\Main\DriverController@update', $model->id],
              'method' => 'put'
              ]) !!}

              <div class="form-group">
                <label> اسم الكابتن</label>
                {!! Form::text('name',null,[
                    'class' => 'form-control'
                ]) !!}

                </div>
                <div class="form-group">
                    <label>رقم التليفون الكابتن</label>
                    {!! Form::text('phone',null,[
                        'class' => 'form-control'
                    ]) !!}

                </div>
                <div class="form-group">
                    <label> جنسية الكابتن</label>
                    {!! Form::text('nationality',null,[
                        'class' => 'form-control'
                    ]) !!}

                </div>
              
                
                
                <div class="form-group">
                    <label> اسم المكتب</label>
                    {!! Form::select('office_id', $office ,$selectedid,['class' => 'form-control','placeholder'=>' اخر المكتب']) !!}

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
@endsection


