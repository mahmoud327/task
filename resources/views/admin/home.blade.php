@extends('layouts.main')

@section('page_title')
    الصفحة الرئيسية
@endsection
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
@section('content')
    <section class="content-header">
        <h1>
            لوحة التحكم
            <small>الصفحة الرئيسية</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
            <li class="active">الصفحة الرئيسية </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">

                            <h2> لايوجد مكاتب </h2>


                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>


                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">


                            <h3><sup style="font-size: 20px"></sup></h3>

                            <p> عدد الموظفين </p>

                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        @can('المستخدمين')
                            <a href="{{ route('user.index') }}" class="small-box-footer"> عرض الموظفين <i
                                    class="fa fa-arrow-circle-left"></i></a>
                        @endcan

                    </div>

                </div><!-- ./col -->






            </div>


            <div class="col-lg-12">
                <div class="col-lg-6">

                    <div class="box box-success" style="height: 410px;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bar Chart</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                </div>
                <div class="col-lg-6">

                    <div class="box-body">

                        <div class="chart">

                            <div id="pie_chart">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
            <!-- Main row -->


            <!-- /.col (LEFT) -->


    </section><!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
