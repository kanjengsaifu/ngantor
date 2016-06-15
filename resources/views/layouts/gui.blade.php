<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <title>Ngantor | Sistem Informasi Tata Usaha</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport' />
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- FontAwesome 4.3.0 -->
    <link href="{{ asset('vendor/font-awesome-4.3.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{ asset('vendor/adminLTE/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendor/adminLTE/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body class="skin-red">

<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('') }}" class="logo"><b>Ng</b>antor</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="/" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('img/photo.jpg') }}" class="user-image" alt="User Image"/>
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('img/photo.jpg') }}" class="img-circle" alt="User Image"/>
                                <p>
                                   {{ Auth::user()->name }}
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('me/pwd') }}" class="btn btn-default btn-flat">Ganti Password</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Logout</a>
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

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
				<li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Beranda</a></li>

				<li class="header">PEGAWAI</li>
				<li class="{{ Request::is('pegawai*') ? 'active' : '' }}"><a href="{{ url('pegawai') }}"><i class="fa fa-users"></i> Daftar</a></li>

				<li class="header">SURAT</li>
				<li class="{{ Request::is('surat/inbox*') ? 'active' : '' }}"><a href="{{ url('surat/inbox') }}"><i class="fa fa-envelope"></i> Kotak Surat</a></li>
				<li class="{{ Request::is('surat/masuk*') ? 'active' : '' }}"><a href="{{ url('surat/masuk') }}"><i class="fa fa-envelope"></i> Surat Masuk</a></li>
            </ul>

        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
				@yield('title', 'Beranda')
            </h1>
            <ol class="breadcrumb">
				@yield('path')
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

		@yield('content')

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>
</div><!-- ./wrapper -->


<!-- jQuery 2.1.3 -->
<script src="{{ asset('vendor/jquery/jQuery-2.1.3.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- InputMask -->
<script src="{{ asset('vendor/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('vendor/adminLTE/js/app.js') }}" type="text/javascript"></script>
@yield('script')

</body>
</html>
