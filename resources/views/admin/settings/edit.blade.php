@extends('layouts.main')
@section('page_title')
الأعدات
@endsection

@section('content')



<section class="content-header">
    <h1>
        لوحة التحكم
        <small>الأعدات</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li class="active">الأعدات</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">


    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">الأعدات</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
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
                    'action' => ['Admin\Main\SettingController@update', $model->id],
                    'method' => 'put'
                    ]) !!}

                    <div class="form-group">
                      <label>About us</label>
                      {!! Form::textarea('about_us',null,[
                        'class' => 'form-control'
                      ]) !!}

                    </div>

                    <div class="form-group">
                      <label>phone</label>
                      {!! Form::text('phone',null,[
                        'class' => 'form-control'
                      ]) !!}

                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      {!! Form::text('email',null,[
                        'class' => 'form-control'
                      ]) !!}

                    </div>
                   
                    <div class="form-group">
                      <label>Youtube_link</label>
                      {!! Form::text('youtube_link',null,[
                        'class' => 'form-control'
                      ]) !!}

                    </div>

                    </div>

                    <div class="form-group">
                      <label>facebook_link</label>
                      {!! Form::text('fb_link',null,[
                        'class' => 'form-control'
                      ]) !!}

                    </div>

                    <div class="form-group">
                      <label>Whatsapp_link</label>
                      {!! Form::text('whatsapp_link',null,[
                        'class' => 'form-control'
                      ]) !!}

                    </div>

                    <div class="form-group">
                      <label>سعر الكيلو</label>
                      {!! Form::text('killo',null,[
                        'class' => 'form-control'
                      ]) !!}

                    </div>

               

                   

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary"> حفظ </button>
                    </div>

                    {!! Form::close() !!}
          </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div><!-- /.col -->
  </div><!-- /.row -->


    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

</section><!-- /.content -->
@endsection

