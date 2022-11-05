@extends('layouts.main')
@section('page_title')
    اضافه سياره جديد
@endsection
@section('content')

    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>المناطق </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li><a href="{{ route('areas.index') }}"> المناطق </a></li>
            <li class="active">اضافة منطقه</li>
        </ol>
    </section>

    <section class="content">
        <!-- row opened -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="card-title mg-b-0"> اضافة منطقه</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        {{-- inject Type Model --}}


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
                       

                        <form action="{{ route('areas.store') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label> اسم المنطقه </label>
                                    {!! Form::text('area_name', null, [
                                        'class' => 'form-control',
                                    ]) !!}

                                </div>
                                <div class="form-group">
                                    <label> التكلفه </label>
                                    {!! Form::number('cost', null, [
                                        'class' => 'form-control',
                                    ]) !!}

                                </div>



                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> حفظ </button>
                            </div>

                       </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
        </div><!-- /.row -->


        <!-- main-content closed -->
    </section>


@endsection
@section('js')
@endsection
