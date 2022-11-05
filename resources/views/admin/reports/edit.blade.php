@extends('layouts.main')
@section('page_title')
  بيانات السيارة
@endsection
@section('content')

<section class="content-header">
    <h1>
        لوحة التحكم
        <small>تعديل بيانات السيارة </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li><a href="{{route('driver.index')}}">  السيارات  </a></li>
        <li class="active">تعديل    بيانات السيارة</li>
    </ol>
</section>

<section class="content">
    <!-- row opened -->
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h4 class="card-title mg-b-0"> تعديل  بيانات السيارة</h4>
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
              'action' => ['Admin\Main\CarController@update', $model->id],
              'method' => 'put'
              ]) !!}

                <div class="form-group">
                    <label> نوع السياره </label>
                    {!! Form::text('types',null,[
                        'class' => 'form-control'
                    ]) !!}

                    </div>
                    <div class="form-group">
                        <label> موديل السيارة</label>
                        {!! Form::text('model',null,[
                            'class' => 'form-control'
                        ]) !!}

                    </div>
                    <div class="form-group">
                        <label> لون السياره</label>
                        {!! Form::text('color',null,[
                            'class' => 'form-control'
                        ]) !!}

                    </div>
                    <div class="form-group">
                        <label>رقم اللوحه</label>
                        {!! Form::text('plate',null,[
                            'class' => 'form-control'
                        ]) !!}

                    </div>
                    <div class="form-group">
                        <label>رقم العداد</label>
                        {!! Form::text('count_number',null,[
                            'class' => 'form-control'
                        ]) !!}

                    </div>
                    
                    <div class="form-group">
                        <label>  الفئه</label>
                        {!! Form::select('type_id', $type ,$selecttype,['class' => 'form-control','placeholder'=>' اخر الفئه']) !!}
    
                      </div>
                    </div>
                
 
                
                <div class="form-group">
                    <label> اسم المكتب</label>
                    {!! Form::select('office_id', $office ,$selectedid,['class' => 'form-control','placeholder'=>' اخر المكتب']) !!}

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
@endsection


