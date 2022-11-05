@extends('layouts.main')
@section('page_title')
المشرفين
@endsection




@section('content')




<section class="content-header">
    <h1>
        لوحة التحكم
        <small>المشرفين</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li class="active">المشرفين</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="{{ route('admin.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="user_id" id="user_id" value="">
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
        <h3 class="box-title">المشرفين</h3>
        @can('اضافة مشرف')
          <a class="btn btn-primary btn-sm" href="{{ route('admin.create') }}">اضافة مشرف</a>     
        @endcan
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('flash::message')
            <div class="table-responsive hoverable-table">
                <table class="table table-hover">
                    <thead>
                        <tr>



                            <th>#</th>
                            <th>اسم المستخدم</th>
                            <th>البريد الالكتروني</th>
                            <th>حالة المستخدم</th>
                            <th>نوع المستخدم</th>
                            <th>العمليات</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->activate == '1')
                                              مفعل
                                    @else
                                              غير مفعل
                                    @endif
                                </td>

                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>

                                <td>
                                    @can('تعديل مشرف')
                                        <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-sm btn-info"
                                            title="تعديل"><i class="fa fa-edit"></i></a>
                                     @endcan
                                     
                                     @can('حذف مشرف')
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-user_id="{{ $user->id }}" data-username="{{ $user->name }}"
                                            data-toggle="modal" href="#modaldemo8" title="حذف"><i
                                                class="fa fa-trash"></i></a>
                                    @endcan
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

<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

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
