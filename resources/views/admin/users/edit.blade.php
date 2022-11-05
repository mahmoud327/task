@extends('layouts.main')
@section('page_title')
تعديل موظف
@endsection

@section('css')

@endsection

@section('content')


    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>تعديل موظف</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li><a href="{{route('user.index')}}">  الموظفين </a></li>
            <li class="active">تعديل موظف</li>
        </ol>
    </section>




    <section class="content">
        <!-- row opened -->
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h4 class="card-title mg-b-0"> تعديل موظف</h4>
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
                           <a class="btn btn-primary btn-sm" href="{{ route('user.index') }}">رجوع</a>
                       </div>
                   </div><br>

                   {!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id]]) !!}
                   <div class="">

                       <div class="row mg-b-20">
                           <div class="parsley-input col-md-6" id="fnWrapper">
                               <label>اسم الموظف: <span class="tx-danger">*</span></label>
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

                            <label>المكتب: <span class="tx-danger">*</span></label>
                            {!! Form::select('office_id', $offices, $selectedID, ['class' => 'form-control']) !!}                                            </div>
                        </div>

                    </div>

                   <div class="row mg-b-20">
                       <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                           <label>كلمة المرور: <span class="tx-danger">*</span></label>
                           {!! Form::password('password', array('class' => 'form-control')) !!}
                       </div>

                       <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                           <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                           {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                       </div>
                   </div>

                   

                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                    <label>نسبة الخصم: <span class="tx-danger">*</span></label>
                    {!! Form::text('discount_per', null, array('class' => 'form-control','required')) !!}

                </div>

                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                    <label> فرع المكتب: <span class="tx-danger">*</span></label>
                    {!! Form::text('branch', null, array('class' => 'form-control','required')) !!}


                </div>
                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                    <label>  وقت بداية العمل: <span class="tx-danger">*</span></label>
                    {!! Form::time('time', null, array('class' => 'form-control','required')) !!}


                </div>
                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                    <label>  وقت انتهاء العمل: <span class="tx-danger">*</span></label>
                    {!! Form::time('time_end', null, array('class' => 'form-control','required')) !!}


                </div>

                   <div class="row row-sm mg-b-20">
                       <div class="col-lg-6">
                           <label class="form-label">حالة الموظف</label>
                           <select name="activate" id="select-beast" class="form-control  nice-select  custom-select">

                               <option @if($user->activate) selected @endif value="1">مفعل</option>
                               <option @if(!$user->activate) selected @endif value="0"> غير مفعل </option>

                           </select>
                       </div>
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

@endpush
