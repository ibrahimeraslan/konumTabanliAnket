<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', '') }}</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Responsive HTML5 Template">
    <meta name="author" content="okler.net">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/template/vendor/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/vendor/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/vendor/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/vendor/magnific-popup/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('/template/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/theme-elements.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/theme-blog.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/theme-shop.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/theme-animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/vendor/rs-plugin/css/settings.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('/template/vendor/rs-plugin/css/layers.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('/template/vendor/rs-plugin/css/navigation.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('/template/vendor/circle-flip-slideshow/css/component.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('/template/css/skins/default.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/vendor/jquery.toast/jquery.toast.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/css/custom.css') }}">
    <script src="{{ asset('/template/vendor/modernizr/modernizr.js') }}"></script>


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="body">
    <header id="header" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}'>
        <div class="header-body">
            <div class="header-container container">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-logo">
                            <a href="{{ URL::to('/') }}">
                                <img alt="{{ config('app.name', '') }}" width="72" height="81" data-sticky-width="47" data-sticky-height="57" data-sticky-top="38" src="{{ asset('/template/img/logo.png') }}">
                            </a>
                        </div>
                    </div>
                    <div class="header-column">
                        <div class="header-row">

                            <nav class="header-nav-top">

                                <ul class="nav nav-pills">
                                    <li class="hidden-xs">
                                        <span class="ws-nowrap"><i class="fa fa-envelope"></i> {{ $ayarlar->site_mail }}</span>
                                    </li>
                                    <li class="hidden-xs">
                                        <span class="ws-nowrap"><i class="fa fa-phone"></i> {{ $ayarlar->site_tel }}</span>
                                    </li>
                                    <ul class="header-social-icons social-icons hidden-xs" style="margin:0; margin-left:10px;">
                                        <li class="social-icons-facebook"><a href="{{ $ayarlar->facebook }}" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li class="social-icons-twitter"><a href="{{ $ayarlar->twitter }}" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li class="social-icons-youtube"><a href="{{ $ayarlar->youtube }}" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-row">
                            <div class="header-nav">
                                <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
                                    <i class="fa fa-bars"></i>
                                </button>


                                <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
                                    <nav>
                                        <ul class="nav nav-pills" id="mainNav">
                                            <li class="dropdown"><a href="{{ URL::to('/') }}">Anasayfa</a></li>
                                            @foreach($sayfalar as $sayfa)
                                                <li class="dropdown"><a href="{{ URL::to('page/show/'.$sayfa->id) }}">{{ $sayfa->sayfa_adi }}</a></li>
                                            @endforeach
                                            <li class="dropdown"><a href="{{ URL::to('page/sss') }}">Sık Sorulan Sorular</a></li>
                                            <li class="dropdown"><a href="{{ URL::to('page/iletisim') }}">İLETİŞİM</a></li>
                                            @if (Auth::guest())
                                                <li class="dropdown dropdown-mega dropdown-mega-signin signin" id="headerAccount">
                                                    <a class="dropdown-toggle" href="#">
                                                        <i class="fa fa-user"></i> Oturum Aç
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <div class="dropdown-mega-content">
                                                                <div class="row">
                                                                    <div class="col-md-12">

                                                                        <div class="signin-form">

                                                                            <span class="dropdown-mega-sub-title">Oturum Aç</span>
                                                                            <form method="POST" id="frmSignIn" action="{{ url('/login') }}">
                                                                                {{ csrf_field() }}
                                                                                <div class="row">
                                                                                    <div class="form-group">
                                                                                        <div class="col-md-12">
                                                                                            <label>E-mail Adresiniz</label>
                                                                                            <input type="email" name="email" required autofocus value="" class="form-control input-lg" tabindex="1">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group">
                                                                                        <div class="col-md-12">
                                                                                            <a class="pull-right mt-none p-none" id="headerRecover" href="#">(Şifremi Unuttum)</a>
                                                                                            <label>Şifreniz</label>
                                                                                            <input id="password" type="password" name="password" required value="" class="form-control input-lg" tabindex="2">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
																							<span class="remember-box checkbox">
																								<label for="rememberme">
																									<input type="checkbox" id="rememberme" name="remember">Beni Hatırla
																								</label>
																							</span>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <input type="submit" value="Giriş" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                                                    </div>
                                                                                </div>
                                                                            </form>

                                                                            <p class="sign-up-info">Hesabınız yok mu? <a href="{{ URL::to('/register/') }}" class="p-none m-none ml-xs">Hesap Oluştur</a></p>

                                                                        </div>
                                                                        <div class="recover-form">
                                                                            <span class="dropdown-mega-sub-title">Şifremi Sıfırla</span>
                                                                            <p>Aşağıdaki formu doldurduktan sonra şifrenizi değiştirebilmeniz için bir şifre sıfırlama maili alacaksınız.</p>
                                                                            <form id="frmResetPassword" role="form" method="POST" action="{{ url('/password/email') }}">
                                                                                {{ csrf_field() }}
                                                                                <div class="row">
                                                                                    <div class="form-group">
                                                                                        <div class="col-md-12">
                                                                                            <label>E-mail Adresiniz</label>
                                                                                            <input type="email"  name="email" value="{{ old('email') }}" id="email" value="" class="form-control input-lg">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <input type="submit" value="Şifremi Sıfırla" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                                                                    </div>
                                                                                </div>
                                                                            </form>

                                                                            <p class="log-in-info">Hesabınız var mı? <a href="#" id="headerRecoverCancel" class="p-none m-none ml-xs">Oturum Aç</a></p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @else
                                                <li class="dropdown dropdown-mega dropdown-mega-signin signin logged" id="headerAccount">
                                                    <a class="dropdown-toggle" href="#">
                                                        <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <div class="dropdown-mega-content">

                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="user-avatar">
                                                                            <div class="img-thumbnail">
                                                                                <img src="{{ URL::to('img/avatar/'.Auth::user()->avatar) }}" alt="">
                                                                            </div>
                                                                            <p><strong>{{ Auth::user()->name }}</strong><span>@if(Auth::user()->tip==1) Normal Kullanıcı @elseif(Auth::user()->tip==2) Anket Veren @endif</span></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <ul class="list-account-options">
                                                                            <li>
                                                                                <a href="{{ URL::to('/kullanici/panel') }}">Panelim</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{ URL::to('/kullanici/ayarlar') }}">Ayarlarım</a>
                                                                            </li>
                                                                            @if(Auth::user()->is_admin==1)
                                                                                <li><a target="_blank" href="{{ URL::to('/admin') }}">Y. Paneli</a></li>
                                                                            @endif
                                                                            <li>
                                                                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                                                        {{ csrf_field() }}
                                                                                    </form>
                                                                                    Oturumu Kapat
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
        @yield('content')
    <footer id="footer">
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-1">
                        <a href="{{ URL::to('/') }}" class="logo">
                            <img style="width:30px" class="img-responsive" src="{{ asset('/template/img/logo.png') }}">
                        </a>
                    </div>
                    <div class="col-md-7">
                        <p>2016-2017 E-Ticaret Dersi Projesi</p>
                    </div>
                    <div class="col-md-4">
                        <nav id="sub-menu">
                            <ul>
                                <li><a href="{{ URL::to('page/sss') }}">Sık Sorulan Sorular</a></li>
                                <li><a href="{{ URL::to('page/iletisim') }}">İletişim</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{ asset('/template/vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('/template/vendor/jquery.appear/jquery.appear.js') }}"></script>
<script src="{{ asset('/template/vendor/jquery.easing/jquery.easing.js') }}"></script>
<script src="{{ asset('/template/vendor/jquery-cookie/jquery-cookie.js') }}"></script>
<script src="{{ asset('/template/vendor/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('/template/vendor/common/common.js') }}"></script>
<script src="{{ asset('/template/vendor/jquery.validation/jquery.validation.js') }}"></script>
<script src="{{ asset('/template/vendor/jquery.stellar/jquery.stellar.js') }}"></script>
<script src="{{ asset('/template/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
<script src="{{ asset('/template/vendor/jquery.gmap/jquery.gmap.js') }}"></script>
<script src="{{ asset('/template/vendor/jquery.lazyload/jquery.lazyload.js') }}"></script>
<script src="{{ asset('/template/vendor/isotope/jquery.isotope.js') }}"></script>
<script src="{{ asset('/template/vendor/owl.carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('/template/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('/template/vendor/vide/vide.js') }}"></script>

<script src="{{ asset('/template/js/theme.js') }}"></script>
<script src="{{ asset('/template/vendor/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('/template/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('/template/vendor/circle-flip-slideshow/js/jquery.flipshow.js') }}"></script>
<script src="{{ asset('/template/js/views/view.home.js') }}"></script>
<script src="{{ asset('/template/vendor/jquery.toast/jquery.toast.js') }}"></script>

<script src="{{ asset('/template/js/custom.js') }}"></script>

<script src="{{ asset('/template/js/theme.init.js') }}"></script>

@if($errors->first())
    @foreach($errors->all() as $error)
        <script>
            $(document).ready(function(){

                $.toast({
                    heading: 'Bilgilendirme',
                    text: '{{ $error }}',
                    showHideTransition: 'slide',
                    hideAfter : 5000,
                    icon: 'warning'
                });

            });
        </script>
    @endforeach
@endif
@if (session('status'))
    <script>
        $(document).ready(function() {
            $.toast({
                heading: 'Bilgilendirme',
                text: '{{ session('status') }}',
                showHideTransition: 'slide',
                hideAfter : 5000,
                icon: 'success'
            });
        });
    </script>
@endif
</body>
</html>
