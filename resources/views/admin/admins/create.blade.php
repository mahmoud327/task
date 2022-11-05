@extends('layouts.main')
@section('page_title')
أضافة مشرف
@endsection




@section('content')

<section class="content-header">
    <h1>
        لوحة التحكم
        <small>أضافة مشرف</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li><a href="{{route('admin.index')}}">  المشرفين </a></li>
        <li class="active">أضافة مشرف</li>
    </ol>
</section>




<section class="content">
    <!-- row opened -->
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h4 class="card-title mg-b-0"> أضافة مشرف</h4>
                <i class="mdi mdi-dots-horizontal text-gray"></i>
            </div><!-- /.box-header -->
            <div class="box-body">

                                        <!-- row -->
                <div class="row">


                    <div class="col-lg-12 col-md-12">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>خطا</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.index') }}">رجوع</a>
                                    </div>
                                </div><br>
                                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                                    action="{{route('admin.store','test')}}" method="post">
                                    {{csrf_field()}}

                                    <div class="">

                                        <div class="row mg-b-20">


                                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                                <label>الاسم: <span class="tx-danger">*</span></label>
                                                <input class="form-control form-control-sm mg-b-20"
                                                    data-parsley-class-handler="#lnWrapper" name="name" required="" type="name">
                                            </div>


                                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0">
                                                <label>الايميل: <span class="tx-danger">*</span></label>
                                                <input class="form-control" name="email" required="" type="email" value="ex@ex.com">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mg-b-20">
                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                            <label>كلمة المرور: <span class="tx-danger">*</span></label>
                                            <input class="form-control" name="password" required type="password">
                                        </div>

                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                            <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                                            <input class="form-control" name="confirm-password" required="" type="password">
                                        </div>
                                    </div>

                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg-6">
                                            <label class="form-label">حالة المستخدم</label>
                                            <select name="activate" id="select-beast" class="form-control  nice-select  custom-select">
                                                <option value=1 >مفعل</option>
                                                <option value=0>غير مفعل</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mg-b-20">
                                        <div class="col-xs-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label"> صلاحية المستخدم</label>
                                                {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button class="btn btn-primary" type="submit">تاكيد</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </div><!-- /.col -->


    <!-- main-content closed -->
</section>









@endsection
@push('js')

@endpush
