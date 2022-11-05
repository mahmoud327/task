@extends('layouts.main')
@section('page_title')
  بيانات المنطقه
@endsection
@section('content')

<section class="content-header">
    <h1>
        لوحة التحكم
        <small>تعديل بيانات المنطقه </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li><a href="{{route('areas.index')}}">  السيارات  </a></li>
        <li class="active">تعديل    بيانات المنطقه</li>
    </ol>
</section>

<section class="content">
    <!-- row opened -->
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h4 class="card-title mg-b-0"> تعديل  بيانات المنطقه</h4>
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

            {{-- {!! Form::model($model,[
              'action' => ['Admin\Main\AreaController@update', $model->id],
              'method' => 'put'
              ]) !!} --}}

              <form action="{{ route('areas.update',$model->id) }}" method="post">
                @csrf
                @method('put')

                    <div class="form-group">
                        <label> اسم المنطقه </label>
                       <input class="form-control" name="area_name" type="text" value="{{$model->area_name }}">

                    </div>
                    <div class="form-group">
                        <label> التكلفه </label>
                        <input class="form-control" name="cost" type="text" value="{{$model->cost }}">


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


