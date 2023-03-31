<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('PageTitle')</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins//fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets') }}/plugins//tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins//icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins//jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins//overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins//daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins//summernote/summernote-bs4.min.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/dist/img/collegefavicon.png" type="image/x-icon">

    {{-- <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/custom.css"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div> --}}
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block {{ Request::routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('logout')}}" class="nav-link">Logout</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>  --}}

                <!-- Messages Dropdown Menu -->
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('assets') }}/dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('assets') }}/dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('assets') }}/dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li> --}}
                <!-- Notifications Dropdown Menu -->
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true"
                        href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('assets') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('assets') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar user panel (optional) -->
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <img src="{{ asset('assets') }}/dist/img/avatar5.png" class="img-circle elevation-2"
                                    alt="User Image">
                            </div>
                            <div class="info">
                                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                            </div>
                        </div>
                        <!-- Sidebar Menu -->
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                @can('is_super_admin')
                                <li class="nav-item ">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fas fa-users-cog "></i>
                                        <p>
                                            Faculty
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="{{route('users')}}"
                                                class="nav-link {{ Request::routeIs('users') ? 'active' : '' }}">
                                                <i class="fas fa-eye"></i>
                                                <p>Faculty Members</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="{{route('users/add')}}"
                                                class="nav-link {{ Request::routeIs('users/add') ? 'active' : '' }}">
                                                <i class="fas fa-plus-circle"></i>
                                                <p>Add Faculty Member</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @elsecan('is_admin')
                                <li class="nav-item ">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fas fa-users-cog  "></i>
                                        <p>
                                            Faculty
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="{{route('users')}}"
                                                class="nav-link {{ Request::routeIs('users') ? 'active' : '' }}">
                                                <i class="fas fa-eye"></i>
                                                <p>Faculty Members</p>
                                            </a>
                                        </li>
                                    </ul>
                                @endcan

                                <li class="nav-item ">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fas fa-university "></i>
                                        <p>
                                            Departments
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="{{ route('departments') }}"
                                                class="nav-link {{ Request::routeIs('departments') ? 'active' : '' }}">
                                                <i class="fa fa-eye"></i>
                                                <p>All Departments</p>
                                            </a>
                                        </li>
                                        @can('is_super_admin')
                                        <li class="nav-item ">
                                            <a href="{{ route('department/create') }}"
                                                class="nav-link {{ Request::routeIs('department/create') ? 'active' : '' }}">
                                                <i class="fa fa-plus-circle"></i>
                                                <p>New Department</p>
                                            </a>
                                        </li>
                                        @endcan
                                    </ul>
                                </li>

                                <li class="nav-item ">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fa fa-book "></i>
                                        <p>
                                            Courses
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="{{ route('courses') }}"
                                                class="nav-link {{ Request::routeIs('courses') ? 'active' : '' }}">
                                                <i class="fas fa-eye"></i>
                                                <p>All Courses</p>
                                            </a>
                                        </li>
                                        @cannot('is_college_advisor')
                                        <li class="nav-item ">
                                            <a href="{{ route('course/create') }}"
                                                class="nav-link {{ Request::routeIs('course/create') ? 'active' : '' }}">
                                                <i class="fa fa-plus-circle"></i>
                                                <p>New Course</p>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a href="{{ route('courses/archived') }}"
                                                class="nav-link {{ Request::routeIs('courses/archived') ? 'active' : '' }}">
                                                <i class="fas fa-archive"></i>
                                                <p>Archived Course</p>
                                            </a>
                                        </li>
                                        @endcannot
                                    </ul>
                                </li>
                                <li class="nav-item ">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                        <p>
                                            Lecturers
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="{{ route('teachers') }}"
                                                class="nav-link {{ Request::routeIs('teachers') ? 'active' : '' }}">
                                                <i class="fas fa-eye"></i>
                                                <p>All Lecturers</p>
                                            </a>
                                        </li>
                                        @cannot('is_college_advisor')
                                        <li class="nav-item ">
                                            <a href="{{ route('teacher/create') }}"
                                                class="nav-link {{ Request::routeIs('teacher/create') ? 'active' : '' }}">
                                                <i class="fas fa-plus-circle"></i>
                                                <p>New Lecturer</p>
                                            </a>
                                        </li>
                                        @endcannot
                                    </ul>
                                </li>
                                <li class="nav-item ">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fas fa-users "></i>
                                        <p>
                                            Students
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="{{ route('students') }}"
                                                class="nav-link {{ Request::routeIs('students') ? 'active' : '' }}">
                                                <i class="fas fa-eye"></i>
                                                <p>All Students</p>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a href="{{ route('student/create') }}"
                                                class="nav-link {{ Request::routeIs('student/create') ? 'active' : '' }}">
                                                <i class="fas fa-plus-circle"></i>
                                                <p>New Student</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item ">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fas fa-book-open "></i>
                                        <p>
                                            Registration
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="{{ route('courses.register.form') }}"
                                                class="nav-link {{ Request::routeIs('courses.register.form') ? 'active' : '' }}">
                                                <i class="fas fa-plus-circle"></i>
                                                <p>Register Course</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item ">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fas fa-file-alt "></i>
                                        <p>
                                            Exams Results
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="{{ route('result/add') }}"
                                                class="nav-link {{ Request::routeIs('result/add') ? 'active' : '' }}">
                                                <i class="fas fa-plus-circle"></i>
                                                <p>Add Result</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @cannot('is_college_advisor')
                                    
                                <li class="nav-item ">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fa fa-cogs "></i>
                                        <p>
                                            Settings
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="{{ route('update/status') }}"
                                                class="nav-link">
                                                <i class="fas fa-sync-alt"></i>
                                                <p>Update Students Status</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview ">
                                        <li class="nav-item ">
                                            <a href="#" class="nav-link ">
                                                <i class="nav-icon fas fa-clock "></i>
                                                <p>
                                                    Required Hours
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview ">
                                                <li class="nav-item ">
                                                    <a href="{{route('required_hours/show')}}"
                                                        class="nav-link">
                                                        <i class="fas fa-eye"></i>
                                                        <p>Show</p>
                                                    </a>
                                                </li>
                                                <li class="nav-item ">
                                                    <a href="{{route('required_hours/edit')}}"
                                                        class="nav-link">
                                                        <i class="fas fa-edit"></i>
                                                        <p>Edit</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                @endcannot
                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> @yield('PageHeader')
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            @yield('content')
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; 2023
                <a href="#">Diaa Mohammed </a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                {{-- <b>Version</b> 3.2.0 --}}
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets') }}/plugins//jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets') }}/plugins//jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins//bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>

    <!-- ChartJS -->
    <script src="{{ asset('assets') }}/plugins//chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets') }}/plugins//sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets') }}/plugins//jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('assets') }}/plugins//jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets') }}/plugins//jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets') }}/plugins//moment/moment.min.js"></script>
    <script src="{{ asset('assets') }}/plugins//daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins//tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets') }}/plugins//summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets') }}/plugins//overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets') }}/dist/js/adminlte.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('assets') }}/dist/js/demo.js"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('assets') }}/dist/js/pages/dashboard.js"></script>     --}}
    <script type="text/javascript">
        $('#summernote').summernote({
            height: 400
        });
    </script>
</body>

</html>
