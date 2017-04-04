@php
  switch (Auth::user()->level) {
    case '1':
      $base = 'root/';
      break;
    case '2':
      $base = 'admin/';
      break;
    default:

      break;
  }
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{config('app.name')}}</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="{{asset('css/roboto.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="{{asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}">
    <link href="{{asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('css/themes/all-themes.css')}}" rel="stylesheet" />
</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Sedang meload data ... </p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{url('/')}}">{{config('app.name')}}</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{asset('images/user.png')}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                    <div class="email">{{Auth::user()->username}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{url('/profile')}}"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Keluar</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN MENU</li>
                    <li id="gudang">
                        <a href="javascript:void(0)" class="menu-toggle">
                            <i class="material-icons">dashboard</i>
                            <span>Gudang</span>
                        </a>
                        <ul class="ml-menu">
                          <li id="stok">
                              <a href="{{url('gudang/stok')}}">Stok</a>
                          </li>
                          <li id="gabah">
                              <a href="{{url('gudang/gabah')}}">Gabah</a>
                          </li>
                          <li id="beras">
                              <a href="{{url('gudang/beras')}}">Beras Gabah</a>
                          </li>
                          <li id="berasbeli">
                              <a href="{{url('gudang/beliberas')}}">Beras Beli</a>
                          </li>
                          <li id="sekam">
                              <a href="{{url('gudang/sekam')}}">Sekam</a>
                          </li>
                          <li id="dedak">
                              <a href="{{url('gudang/dedak')}}">Dedak</a>
                          </li>
                        </ul>
                    </li>
                    <li id="penjualan">
                        <a href="{{url('penjualan')}}">
                            <i class="material-icons">shopping_cart</i>
                            <span>Penjualan</span>
                        </a>
                    </li>
                    <li id="kepegawaian">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">group</i>
                            <span>Kepegawaian</span>
                        </a>
                        <ul class="ml-menu">
                            <li id="pegawai">
                                <a href="{{url('kepegawaian/pegawai')}}">Pegawai</a>
                            </li>
                            <li id="absensi">
                                <a href="{{url('kepegawaian/absen')}}">Absensi</a>
                            </li>
                            <li id="penggajian">
                                <a href="{{url('kepegawaian/penggajian')}}">Penggajian</a>
                            </li>
                        </ul>
                    </li>
                    <li id="laporan">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">print</i>
                            <span>Laporan</span>
                        </a>
                        <ul class="ml-menu">
                            <li id="harian">
                                <a href="{{url('laporan/harian#print')}}">Print Laporan Hari Ini</a>
                            </li>
                        </ul>
                    </li>
                    @if (Auth::user()->level == 1)
                      <li id="users">
                          <a href="{{url('users')}}">
                              <i class="material-icons">group</i>
                              <span>Users</span>
                          </a>
                      </li>
                    @endif
                    <li id="pengaturan">
                        <a href="{{url('pengaturan')}}">
                            <i class="material-icons">settings</i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <!--<div class="copyright">
                    &copy; 2017 <a href="https://progress.or.id">Ormawa Manager - PROGRESS DEV</a>
                </div> -->
                <div class="version">
                    <b>Version: </b> 1.0 Beta
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <!-- #END# Right Sidebar -->
    </section>

    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Select Plugin Js -->
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('plugins/node-waves/waves.js')}}"></script>
    <!-- Autosize Plugin Js -->
    <script src="{{asset('plugins/autosize/autosize.js')}}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{asset('plugins/momentjs/moment.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="{{asset('plugins/bootbox/bootbox.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('plugins/editable-table/mindmup-editabletable.js')}}"></script>
    <script src="{{asset('js/pages/tables/editable-table.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('js/menu.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="{{asset('js/pages/forms/basic-form-elements.js')}}"></script>
    <script src="{{asset('js/pages/ui/notifications.js')}}"></script>
    @yield('js')
    <!-- Demo Js -->
    <script src="{{asset('js/demo.js')}}"></script>

</body>

</html>
