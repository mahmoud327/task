@extends('layouts.main')
@section('page_title')
التقارير الكباتن
@endsection
 
@section('content')
    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>  الموظفين </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li class="active">  التقارير الموظففين</li>
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
                   <h3 class="box-title">التقارير الموظففين   </h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                
                
                            <div class="card-header pb-0">
                
                                <form action="{{route('Searchusers')}}" method="POST" role="search" autocomplete="off">
                                    {{ csrf_field() }}
                
                
                                    <div class="row">
                
                                        <div class="col-lg-3 ">
                                                <label> اسم المكتب</label>
                                                @inject('office','App\Models\Office')
                                                {!! Form::select('office_id', $office->pluck('name','id')->toArray(),null, ['class' => 'form-control','id'=>'office','placeholder'=>'اختر المكتب']) !!}
                
                                        </div>

                                        <div class="col-lg-3 ">
                                            <label for="inputName" class="control-label"> اسم الموظف</label>
                                            @inject('driver','App\Models\Driver')
                                            {!! Form::select('user_id',[],null, ['class' => 'form-control','id'=>'user','placeholder'=>'اختر الموظف']) !!}
            
                                            
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
                                @if (isset($invoices))
                                <h4>  عدد الرحلات للموظف :-{{count($invoices)}}</h4>

                                    <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">اسم الموظف</th>
                                                <th class="border-bottom-0">رقم الفاتورة</th>
                                                <th class="border-bottom-0">تاريخ القاتورة</th>
                                                <th class="border-bottom-0"> اسم العميل</th>
                                                <th class="border-bottom-0">محطة الانطلاق</th>
                                                <th class="border-bottom-0">محظة الوصول</th>
                                                <th class="border-bottom-0">حالة الرحلة </th>
                                                <th class="border-bottom-0">الاجمالي</th>
            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                         @foreach ($invoices as $invoice)
                                            <?php $i++; ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $invoice->user()->first()->name }} </td>

                                                <td>{{ $invoice->id }} </td>
                                                <td>{{ $invoice->invoice_Date }}</td>
                                                <td>{{ $invoice->username }}</td>
                                                <td>{{ $invoice->fromplace }}</td>
                                            
                                                <td>{{ $invoice->toplace }}</td>
                                                <td>{{ $invoice->Status }}</td>
                                                <td>{{ $invoice->Total }}</td>

    
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
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>


    
<script>
        //if governorates changed
    $("#office").change(function (e){
        e.preventDefault();
        
        // get gov
        var office = $("#office").val();
        
        if(office)
        {
            $.ajax({
                url      : '{{url('office_user?office=')}}'+office,
                type     : 'get',
                success  : function (data) {
                if(data.status == 1)
                {
                    $("#user").empty();
                    $("#user").append('<option >اختر الموظف</option>');
                    $.each(data.data, function(index,user){
                    $("#user").append('<option value="'+user.id+'">'+user.name+'</option>');
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
            $("#user").empty();
            $("#user").append('<option >اختر الموظف</option>');
            }
      });
    </script>

  @endpush

@endsection