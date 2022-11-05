@extends('layouts.main')
@section('page_title')
تعديل  الفئه
@endsection
@section('content')

<section class="content-header">
    <h1>
        لوحة التحكم
        <small> الفئات</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li><a href="{{route('types.index')}}">   الفئات </a></li>
        <li class="active">   تعديل الفئه</li>
    </ol>
</section>

<section class="content">
    <!-- row opened -->
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h4 class="card-title mg-b-0"> تعديل   الفئه</h4>
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
              'action' => ['Admin\Main\TypeController@update', $model->id],
              'method' => 'put'
              ]) !!}

              <div class="form-group">
                <label>الاسم</label>
                {!! Form::text('name',null,[
                  'class' => 'form-control'
                ]) !!}

              </div>

              <div class="form-group">
                <label>سعر الفئه</label>
                {!! Form::text('price',null,[
                    'class' => 'form-control'
                ]) !!}

             </div>
             
              <div class="form-group">
                <button type="submit" class="btn btn-primary"> تعديل </button>
              </div>

              {!! Form::close() !!}

              </div><!-- /.box-body -->
          </div><!-- /.box -->

        </div><!-- /.col -->
      </div><!-- /.row -->


    <!-- main-content closed -->
</section>
@endsection


