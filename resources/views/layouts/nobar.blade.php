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
    <script src="{{ asset('/template/vendor/jquery/jquery.js') }}"></script>

</head>
<body>
<div class="body">
    @yield('content')
</div>
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
<style>
.boxshadow{
    -webkit-box-shadow: none;
    box-shadow: none;
}
</style>
</html>
