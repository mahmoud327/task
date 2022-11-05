@extends('layouts.main')
@section('page_title')
 عرض الصلاحيات
@endsection

@section('css')
<link href="{{URL::asset('assets/js-tree/themes/default/style.css')}}" rel="stylesheet">
@endsection

@section('content')


<section class="content-header">
    <h1>
        لوحة التحكم
        <small>تعديل صلاحية</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li><a href="{{route('roles.index')}}">  الصلاحيات </a></li>
        <li class="active"> صلاحية  {{ $role->name }}</li>
    </ol>
</section>





<section class="content">

    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">الصلاحية {{ $role->name }}</h3>

        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <!-- col -->
                <div class="col-lg-4">
                    <ul id="treeview1">
                        <li><a href="#">{{ $role->name }}</a>
                            <ul>
                                @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                <li>{{ $v->name }}</li>
                                @endforeach
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /col -->
            </div>
          </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div><!-- /.col -->
  </div><!-- /.row -->


    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

</section><!-- /.content -->



@endsection

@push('js')


@endpush
