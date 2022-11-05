@extends('layouts.main')
@section('page_title')
الاعلانات
@endsection

@section('content')

  <section class="content-header">
        <h1>
            لوحة التحكم
            <small>الاعلانات</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li class="active">الاعلانات</li>
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

                <form action="{{ route('work.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="work_id" id="user_id" value="">
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
            <h3 class="box-title">الأعلانات</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                @include('flash::message')
                {!! $dataTable->table([
                'class'=>'dataTable table table-striped table-hover  table-bordered'
                ]) !!}
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->


    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

</section><!-- /.content -->

    @push('dt_js')
        {!! $dataTable->scripts() !!}
    @endpush
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

