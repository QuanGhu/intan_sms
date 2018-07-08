<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Puskesmas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/jquery-confirm.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
    <div class="page-loader-wrapper" style="display: none">
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
        </div>
    </div>
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

      </nav>

      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index.html" class="brand-link">
          <span class="brand-text font-weight-light">Puskesmas Taram</span>
        </a>
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->email }}</a>
            </div>
          </div>
    
        @include('layout.sidebar')
        </div>
      </aside>
    
      <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{$title}}</h1>
              </div>
            </div>
          </div>
        </section>
    
        <section class="content">
            @yield('content')
        </section>
      </div>
    
      <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
          <b>Version</b> 1.0.0-alpha
        </div>
        <strong>Copyright &copy; 2018 </strong>
        reserved.
      </footer>

    </div>
    
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    @stack('scripts')
    </body>
</html>
