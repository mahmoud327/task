@extends('layouts.main')
@section('page_title')
اضافه كابتن جديد
@endsection
@section('content')

    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>الكباتن </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li><a href="{{route('driver.index')}}">  الكباتن </a></li>
            <li class="active">اضافة كابتن</li>
        </ol>
    </section>

    <section class="content">
        <!-- row opened -->
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h4 class="card-title mg-b-0"> اضافة كابتن</h4>
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
                'action' => 'Admin\Main\DriverController@store'
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
                    @inject('office','App\Models\Office')
                    {!! Form::select('office_id', $office->pluck('name','id')->toArray(),null, ['class' => 'form-control','placeholder'=>' اخر المكتب']) !!}

                  </div>






                <div class="form-group">
                    <label class="form-label">حالة الكابتن</label>
                    <select name="activate" id="select-beast" class="form-control  nice-select  custom-select">
                        <option value=1 >مفعل</option>
                        <option value=0>غير مفعل</option>
                    </select>
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

