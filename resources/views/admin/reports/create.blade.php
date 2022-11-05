@extends('layouts.main')
@section('page_title')
اضافه سياره جديد
@endsection
@section('content')

    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>السيارات </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li><a href="{{route('driver.index')}}">  السيارات </a></li>
            <li class="active">اضافة سائق</li>
        </ol>
    </section>

    <section class="content">
        <!-- row opened -->
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h4 class="card-title mg-b-0"> اضافة سيارة</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div><!-- /.box-header -->
                <div class="box-body">

                {{-- inject Type Model --}}
                @inject('model','App\Models\Driver')


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
                'action' => 'Admin\Main\CarController@store'
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
                    <label> فئه السيارة </label>
                    @inject('type','App\Models\Type')
                    {!! Form::select('type_id', $type->pluck('name','id')->toArray(),null, ['class' => 'form-control','placeholder'=>' اختر فئة']) !!}

                </div>



                <div class="form-group">
                    <label> اسم المكتب</label>
                    @inject('office','App\Models\Office')
                    {!! Form::select('office_id', $office->pluck('name','id')->toArray(),null, ['class' => 'form-control','placeholder'=>' اختر المكتب']) !!}

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
@section('js')

@endsection

