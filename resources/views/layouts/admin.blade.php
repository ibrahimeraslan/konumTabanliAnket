<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', '') }} Yönetim Paneli</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('adminTheme/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('adminTheme/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminTheme/dist/css/skins/skin-blue.min.css') }}">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <a href="{{ URL::to('/admin') }}" class="logo">
      <span class="logo-mini"><b>T</b>PL</span>
      <span class="logo-lg"><b>Tr</b>poll</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('img/avatar/'.Auth::user()->avatar ) }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ asset('img/avatar/'.Auth::user()->avatar ) }}" class="img-circle" alt="User Image">
                <p>
                  {{ Auth::user()->name }}
                  <small>Üyelik: {{ Auth::user()->created_at }}</small>
                </p>
              </li>
                     <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ URL::to('/') }}" target="_blank" class="btn btn-default btn-flat">Siteye Git</a>
                </div>
                <div class="pull-right">
                  <form action="{{ URL::to('logout') }}" method="post" name="adminCikis">
                    {{ csrf_field() }}
                    </form>
                  <a href="#" onclick="adminCikis.submit()" class="btn btn-default btn-flat">Oturumu Kapat</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">

    <section class="sidebar">

      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('img/avatar/'.Auth::user()->avatar ) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>


      <ul class="sidebar-menu">
        <li class="header">Menüler</li>
        <li class="active"><a href="{{ URL::to('/admin/sistemAyar') }}"><i class="fa fa-gear"></i> <span>Sistem Ayarları</span></a></li>
        <li><a href="#"><i class="fa fa-money"></i> <span>Bütçe Yönetimi</span></a></li>
        <li><a href="#"><i class="fa fa-user"></i> <span>Üye Yönetimi</span></a></li>
        <li><a href="#"><i class="fa fa-pie-chart"></i> <span>Anket Yönetimi</span></a></li>
        <li><a href="#"><i class="fa fa-question-circle"></i> <span>Soru Yönetimi</span></a></li>
        <li><a href="#"><i class="fa fa-file"></i> <span>Sistem Sayfaları Yönetimi</span></a></li>
        <li><a href="{{ URL::to('/admin/sss') }}"><i class="fa fa-info-circle"></i> <span>SSS Yönetimi</span></a></li>
        <li><a href="#"><i class="fa fa-users"></i> <span>Meslek Yönetimi</span></a></li>
        <li><a href="#"><i class="fa fa-credit-card"></i> <span>Ödeme İstekleri Yönetimi</span></a></li>
        <li><a href="{{ URL::to('/admin/iletisim') }}"><i class="fa fa-globe"></i> <span>İletişim Mesajları Yönetimi</span></a></li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    @if($errors->first())
      @foreach($errors->all() as $error)
    <div class="col-md-12">
          <div class="alert alert-danger">
            {{ $error }}
          </div>

    </div>
      @endforeach
    @endif

      @if (session('status'))
        <div class="col-md-12">
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        </div>
      @endif
  @yield('content')
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <a href="#"><i class="fa fa-arrow-up"></i></a>
    </div>
    <strong>Copyright &copy; 2016 <a href="#">Trpoll</a>.</strong> Tüm Hakları Saklıdır.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>

<script src="{{ asset('adminTheme/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('adminTheme/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminTheme/dist/js/app.min.js') }}"></script>
</body>
</html>
