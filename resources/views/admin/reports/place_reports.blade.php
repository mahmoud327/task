@extends('layouts.main')
@section('page_title')
التقارير الواجهات
@endsection

@section('content')
    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>  الواجهات </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li class="active">  التقارير الواجهات</li>
        </ol>
    </section>


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

<!-- row -->
<section class="content">





    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                   <h3 class="box-title">التقارير الواجهات   </h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <div class="col-xl-12">
                        <div class="card mg-b-20">


                            <div class="card-header pb-0">

                                <form action="{{route('Searchplace')}}" method="POST" role="search" autocomplete="off">
                                    {{ csrf_field() }}


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="rdiobox">
                                                <input checked name="rdio" type="radio" value="1" id="type_div"> <span>بحث
                                                    بحث الواجهات كل جه على حده
                                                </span></label>
                                       </div>

                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                            <label class="rdiobox"><input name="rdio" value="2" type="radio"><span>
                                                الواجهات اكتر الرحلات</span></label>

                                        </div><br><br>


                                        <div class="col-lg-3 " >
                                                <label> اسم المكتب</label>
                                                @inject('office','App\Models\Office')
                                                {!! Form::select('office_id', $office->pluck('name','id')->toArray(),null, ['class' => 'form-control','id'=>'office','placeholder'=>'اختر المكتب']) !!}

                                        </div>

                                        <div class="col-lg-3 types">
                                            <label class="form-label"> اختر الرحله</label>
                                            <select name="types" id="types" class="form-control  nice-select  ">
                                              <option selected="selected" >اختر الرحلة</option>
                        
                                                <option  value="in"> داخل المدينه</option>
                                                <option  value="out">بين المدن</option>
                        
                                            </select>
                        
                                          </div>

                                        <div class="col-lg-3 " id="places">
                                            <label for="inputName" class="control-label"> اسم الواجهه</label>
                                            {!! Form::select('place_id',[],null, ['class' => 'form-control','id'=>'place','placeholder'=>'اختر الواجهه']) !!}


                                      </div>

                                        <div class="col-lg-3" id="start_at">
                                            <label for="exampleFormControlSelect1">من تاريخ</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                                    name="start_at" placeholder="YYYY-MM-DD" type="date">
                                            </div><!-- input-group -->
                                        </div>

                                        <div class="col-lg-3" id="end_at">
                                            <label for="exampleFormControlSelect1">الي تاريخ</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                </div><input class="form-control fc-datepicker" name="end_at"
                                                    value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="date">
                                            </div><!-- input-group -->
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-sm-1 col-md-1">
                                            <button class="btn btn-primary btn-block">بحث</button>
                                        </div>
                                    </div>

                               </div>

                                </form>

                            </div>
                        </div>

                        <div class="card-body" style="margin-top:5%">
                            <div class="table-responsive">
                                @if (isset($places))
                                    <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">اسم الواجهه</th>
                                                <th class="border-bottom-0"> عدد الرحلات</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                         @foreach ($places as $place)
                                            <?php $i++; ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $place->name }} </td>

                                                <td>{{ $place->count }}</td>
                                           


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>



                                  @endif
                            </div>
                        </div>



                </div>
             </div><!-- /.box -->

      </div><!-- /.col -->
    </div><!-- /.row -->


    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

</section><->

<!-- Internal Data tables -->

@push('js')

    <script>
        $(document).ready(function() {
            $('#invoice_number').hide();
            $('.types').hide();

            $('input[type="radio"]').click(function() {
                if ($(this).attr('id') == 'type_div') {
                    $('#invoice_number').hide();
                    $('#type').show();
                    $('.types').hide();


                    $('#places').show();
                    $('#start_at').show();
                    $('#end_at').show();
                } else {
                    $('#invoice_number').show();
                    $('#type').hide();
                    $('#places').hide();
                    $('#start_at').hide();
                    $('.types').show();

                    $('#end_at').hide();
                }
            });
      });
  </script>



<script>
        //if governorates changed
    $("#office").on("change",function (e){
        e.preventDefault();

        // get gov
        var office = $("#office").val();

        if(office)
        {
            $.ajax({
                url      : '{{url('place_office?office=')}}'+office,
                type     : 'get',
                success  : function (data) {
                if(data.status == 1)
                {
                    $("#place").empty();
                    $("#place").append('<option >اختر الواجهه</option>');
                    $.each(data.data, function(index,place){
                    $("#place").append('<option value="'+place.id+'">'+place.name+'</option>');
                    });
                }
                },
                error : function (jqXhr, textStatus, errorMessage){
                alert(errorMessage);
                }
            });
            }
            else
            {
            $("#place").empty();
            $("#place").append('<option >اختر الواجهه</option>');
            }
      });
    </script>

  @endpush

@endsection
