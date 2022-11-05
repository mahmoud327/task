<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> @yield('page_title') </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/fonts/fonts-fa.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/bootstrap-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/rtl.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('css')

    <script type="text/javascript">
        function check_all() {
            $('input[class="item_checkbox"]:checkbox').each(function() {
                if ($('input[class="check_all"]:checkbox:checked').length == 0) {
                    $(this).prop('checked', false);
                } else {
                    $(this).prop('checked', true);
                }

            });
        }

        function delete_all() {
            $(document).on('click', '.del_all', function() {
                $('#form_data').submit();
            })
            $(document).on('click', '.delBtn', function() {
                $('#multimodel').modal('show');
                var item_count = $('input[class="item_checkbox"]:checkbox').filter(":checked").length;
                if (item_count > 0) {
                    $('.record_count').text(item_count);
                    $('.not_empty_record').removeClass('hidden');
                    $('.empty_record').addClass('hidden');
                } else {
                    $('.record_count').text('');
                    $('.empty_record').removeClass('hidden');
                    $('.not_empty_record').addClass('hidden');
                }

            });
        }
    </script>

    <script src="{{ URL::asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    @stack('js_exel')

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

    @yield('css')

    <style>
        td,
        th {
            text-align: center
        }

        .dataTables_length,
        .dt-buttons,
        #admindatatable-table_filter {
            display: inline-block;
            margin-bottom: 50px;
        }

        #admindatatable-table_filter {

            margin-right: 10%;

        }

        .dataTables_length {
            float: left;
        }

        .fa-angle-left:before {
            line-height: 50px
        }

        .skin-blue .sidebar-form {
            border-radius: 0;
            border: none
        }
    </style>

</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('admin.home') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">مكاتب </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>مكاتب </b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="position: absolute">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div style="position: absolute;left:0" class="navbar-custom-menu" >
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}"
                                    class="img-circle elevation-2" alt="User Image" height="20">

                                {{-- <span class="hidden-xs">{{ Auth::user()->name }}</span> --}}
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}"
                                        class="img-circle elevation-2" alt="User Image">

                                    <p>
                                        {{-- {{ Auth::user()->name }} --}}
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        @if (Auth::guard('web')->check())
                                        @else
                                            <a href="{{ route('logout') }}" class="btn btn-default btn-flat"> تسجيل
                                                خروج</a>
                                        @endif

                                    </div>
                                    <div class="pull-left">

                                        @if (Auth::guard('web')->check())
                                            <a href="{{ route('admin.logout') }}"
                                                class="btn btn-default btn-flat">تسجيل خروج</a>
                                        @endif


                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->


        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-right image">
                        {{-- <img src="{{ URL::asset('adminlte/images/shoghl.png') }}" class="img-circle" alt="User Image"> --}}
                        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">

                    </div>
                    <div class="pull-left info">
                        {{-- <p>{{Auth::user()->name}}</p> --}}
                        <a href="#"><i class="fa fa-circle text-success"></i> متاح</a>
                    </div>
                </div>
                <!-- search form -->
                {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="بحث ...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> --}}


                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">


                    @if (Auth::guard('web')->check())
                        @can('المكاتب')
                            <li class="header"> المكاتب</li>
                            <li class=" {{ active_menu('office')[0] }} "><a href="{{ route('office.index') }}"><i
                                        class="fa fa-user"></i>المكاتب</a></li>
                        @endcan


                        <li class="header"> المناطق</li>
                        <li class="{{ active_menu('areas')[0] }} {{ active_menu('outtrip')[0] }} treeview">
                            <a href="#">
                                <i class="fa fa-users"></i> <span>المناطق</span> <i
                                    class="fa fa-angle-left pull-left"></i>
                            </a>
                            <ul class="treeview-menu"
                                style="{{ active_menu('areas')[1] }} {{ active_menu('outtrip')[1] }}">

                                <li class="{{ active_menu('outtrip')[0] }}">><a href="{{ route('areas.index') }}"><i
                                            class="fa fa-user"></i>المناطق </a></li>

                            </ul>
                        </li>

                        <li class="header"> البوليصه</li>
                        <li class="{{ active_menu('areas')[0] }} {{ active_menu('outtrip')[0] }} treeview">
                            <a href="#">
                                <i class="fa fa-users"></i> <span>البوليصه</span> <i
                                    class="fa fa-angle-left pull-left"></i>
                            </a>
                            <ul class="treeview-menu"
                                style="{{ active_menu('bills')[1] }} {{ active_menu('bills')[1] }}">

                                <li class="{{ active_menu('bills')[0] }}">><a href="{{ route('bills.index') }}"><i
                                            class="fa fa-user"></i>البوليصه </a></li>

                            </ul>



                    @else
                        <li class="header"> الرحلات</li>
                        <li class="{{ active_menu('inside_city')[0] }} {{ active_menu('user-trips')[0] }} treeview">
                            <a href="#">
                                <i class="fa fa-users"></i> <span>الرحلات</span> <i
                                    class="fa fa-angle-left pull-left"></i>
                            </a>
                            <ul class="treeview-menu"
                                style="{{ active_menu('inside_city')[1] }} {{ active_menu('inside_city')[1] }}">
                                <li class="{{ active_menu('inside_city')[0] }}">><a
                                        href="{{ route('inside_city.index') }}"><i class="fa fa-users"></i>الرحلات
                                        داخل المددينه</a></li>


                                <li class="{{ active_menu('user-trips')[0] }}">><a
                                        href="{{ route('user-trips.index') }}"><i class="fa fa-user"></i>الرحلات بين
                                        المدن</a></li>


                            </ul>
                        </li>
                    @endif



                    {{-- <li class="header"> الاعدادات</li>
            <li class="{{ active_menu('settings')[0] }} {{ active_menu('contacts')[0] }} treeview">
              <a href="#">
                <i class="fa fa-sliders"></i> <span>الاعدادات</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu" style="{{ active_menu('settings')[1] }} {{ active_menu('contacts')[1] }}">
                  {{-- <li class="{{ active_menu('settings')[0] }}"><a href="{{ route('settings.edit', \App\Models\Setting::first()->id ) }}"><i class="fa fa-sliders"></i>الاعدادات</a></li> --}}
                    {{-- <li class="{{ active_menu('contacts')[0] }}"><a href="{{route('admin.contacts')}}"><i class="fa fa-phone"></i>أتصل بنا</a></li> --}}
                </ul>
                {{-- </li> --}}


                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->




            @yield('content')

        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-left hidden-xs">
                <b>Version</b> 2.2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All
            rights reserved.
        </footer>


        <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->


    @stack('dt_js')
    <!-- jQuery UI 1.11.4 -->
    {{-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> --}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script src="{{ URL::asset("adminlte/plugins/jQuery/jQuery-2.1.4.min.js")}}"></script> --}}

    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    @stack('js')
    <!-- Bootstrap 3.3.4 -->
    <script src="{{ URL::asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ URL::asset('adminlte/plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ URL::asset('adminlte/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ URL::asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ URL::asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ URL::asset('adminlte/plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ URL::asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ URL::asset('adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ URL::asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ URL::asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('adminlte/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ URL::asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('adminlte/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/datatables/buttons.server-side.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ URL::asset('adminlte/dist/js/app.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ URL::asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::asset('adminlte/dist/js/demo.js') }}"></script>

     @stack('js')





</body>

</html>
