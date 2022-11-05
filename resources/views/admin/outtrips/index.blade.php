@extends('layouts.main')
@section('page_title')
 الرحلات بين المدن
@endsection

@section('css')
<style>
        .rat
        {
            cursor: pointer;
        }
        .checked {
            color: orange;
        }
</style>
@endsection

@section('content')

<section class="content-header">
    <h1>
        لوحة التحكم
        <small>الرحلات بين المدن </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li class="active"> الرحلات بين البمدن</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">





    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                   <h3 class="box-title">الرحلات بين المدن </h3>
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
    <script>
    delete_all();
    </script>
    {!! $dataTable->scripts() !!}
@endpush
@endsection
@push('js')
    <script>
        $(window).bind("load", function() {

            // alert( $('.rating1').length  );
            var rated = 0,
            rating =  $('.rating');

            // console.log($('.rating').length );
            for(i=0; i < $('.rating').length ; i++ )
            {
                rated = $(rating[i]).data('rating');
                $('#input'+ (i+1) ).val(rated);
                console.log($('#input'+ (i+1) ).val() );
                // $(this).children('"#input'+ i +' "').val(rated);
                $(rating[i]).children('.rated:lt('+ rated +')').addClass('checked');
            }

        });
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