@extends('layouts.main')
@section('page_title')
الصلاحيات
@endsection




@section('content')



<section class="content-header">
    <h1>
        لوحة التحكم
        <small>الصلاحيات</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li class="active">الصلاحيات</li>
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
                        <input type="hidden" name="role_id" id="user_id" value="">
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

    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
         
          <h3 class="box-title">الصلاحيات</h3>
          <br>
          @can('اضافة صلاحيه')
           <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">اضافة</a>
          @endcan
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('flash::message')
            <div class="table-responsive">
                <table class="table mg-b-0 text-md-nowrap table-hover ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>   
                                    @can('الصلاحيات')
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('roles.show', $role->id) }}">عرض</a>
                                    @endcan

                                    @can('تعديل صلاحيه')
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                                     @endcan
                                    @if ($role->name !== 'owner')
                                        @can('حذف صلاحيه')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-user_id="{{ $role->id }}" data-username="{{ $role->name }}"
                                            data-toggle="modal" href="#modaldemo8" title="حذف"><i
                                                class="fa fa-trash"></i></a>
                                       @endcan
                                    @endif


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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

    <script>
        $('#modaldemo8').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var user_id = button.data('user_id')
            var username = button.data('username')
            var modal = $(this)
            modal.find('.modal-body #user_id').val(user_id);
            modal.find('.modal-body #username').val(username);
        })
    </script>

@endpush
