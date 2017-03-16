@php
  switch (Auth::user()->level) {
    case '1':
      $base = 'root/';
      break;
    case '2':
      $base = 'admin/';
      break;
    case '3':
      $base = 'sekretaris/';
      break;
    case '4':
      $base = 'bendahara/';
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
    <title>{{$ormawa->nama_ormawa}} | ORMAWA MANAGAER</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('css/themes/all-themes.css')}}" rel="stylesheet" />
</head>

<body class="theme-red">
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
            <p>Please wait...</p>
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
                <a class="navbar-brand" href="{{url('/')}}">{{$ormawa->nama_ormawa}} - ORMAWA MANAGER</a>
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
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$user->Pengurus->Keanggotaan->Anggota->nama_anggota}}</div>
                    <div class="email">{{$user->email}}</div>
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
                    <li id="dashboard">
                        <a href="{{url('/')}}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @foreach ($menu as $r)
                      @if (count($r->Menu->Submenu) != 0)
                        <li id="{{$r->Menu->id_menu}}">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">{{$r->Menu->icon_menu}}</i>
                                <span>{{$r->Menu->nama_menu}}</span>
                            </a>
                            <ul class="ml-menu">
                                <li id="{{$r->Menu->id_menu}}">
                                    <a href="{{url($base.$r->Menu->link_menu)}}">{{$r->Menu->nama_menu}}</a>
                                </li>
                                @foreach ($r->Menu->Submenu as $s)
                                  <li id="{{$s->id_submenu}}">
                                      <a href="{{url($base.$s->link_submenu)}}">{{$s->nama_submenu}}</a>
                                  </li>
                                @endforeach
                            </ul>
                        </li>
                      @else
                        <li id="{{$r->Menu->id_menu}}">
                            <a href="{{url($base.$r->Menu->link_menu)}}">
                                <i class="material-icons">{{$r->Menu->icon_menu}}</i>
                                <span>{{$r->Menu->nama_menu}}</span>
                            </a>
                        </li>
                      @endif
                    @endforeach
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="https://progress.or.id">Ormawa Manager - PROGRESS DEV</a>
                </div>
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
    
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('js/menu.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/admin.js')}}"></script>

    <!-- Demo Js -->
    <script src="{{asset('js/demo.js')}}"></script>

</body>

</html>
