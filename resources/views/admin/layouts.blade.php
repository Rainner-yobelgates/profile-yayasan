<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin-template/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/assets/css/components.css') }}">
    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.7/datatables.min.css" rel="stylesheet">
    {{-- summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        div.dataTables_wrapper div.dataTables_processing {
            background: none !important;
            background-color: #fff;
            width: auto !important;
            height: auto;
        }
    </style>
</head>

<body>
    @if (Route::currentRouteName() == 'login')
        @yield('content-login')
        @else
        <div id="app">
            <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::user()->name}}</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    </div>
                </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="index.html">AL-MIFFA</a>
                </div>
                {{-- <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.html">MIFFA</a>
                </div> --}}
                @include('admin.menu.index')              
                </aside>
            </div>
        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        
        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2023, AL-MIFFA. All Rights Reserved</a>
                </div>
            </footer>
        </div>

    @endif

  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/v/bs4/dt-1.13.7/datatables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{ asset('admin-template/assets/js/stisla.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <!-- Template JS File -->
  <script src="{{ asset('admin-template/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('admin-template/assets/js/custom.js') }}"></script>
  @if (session()->has('success'))
  <script>
      swal({
      title: "Success",
      text: '{{session()->get('success')}}',
      icon: "success",
      button: "Oke",
  });
  </script>
@endif
  <!-- Page Specific JS File -->
  @yield('script')
</body>
</html>
