@extends('layouts.main')
@section('page_title')

اضافة صلاحية

@endsection

@section('css')

@endsection

@section('content')


<section class="content-header">
    <h1>
        لوحة التحكم
        <small>الصلاحيات</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li><a href="{{route('roles.index')}}">  الصلاحيات </a></li>
        <li class="active">اضافة صلاحية</li>
    </ol>
</section>





<section class="content">


    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="{{ route('roles.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="gov_id" id="user_id" value="">
                        <input class="form-control" name="username" id="username" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </div>
                </form>

        </div>
    </div>


       <!-- row opened -->
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

    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">اضافة صلاحية</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
                @include('flash::message')

                <div class="row">
                    <div class="col-lg-12">
                        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                            <div class="form-group" >
                                <p>اسم الصلاحية :</p>
                                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                            </div>
                    </div>

                    <!-- col -->
                    <div class="col-lg-8">
                        <ul id="treeview1">
                            <li><a href="#">الصلاحيات</a>
                                <ul>
                            </li>
                            @foreach($permission as $value)
                            <label
                                style="font-size: 16px;">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                {{ $value->name }}</label>

                            @endforeach
                            </li>

                        </ul>
                        </li>
                        </ul>
                    </div>
                    <!-- /col -->
                    <div class="col-lg-12 text-center mt-5">
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                    </div>
                    {!! Form::close() !!}
                </div>
        </div>
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
