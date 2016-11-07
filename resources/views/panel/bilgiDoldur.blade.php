@extends('layouts.app')

@section('content')
    @if(Auth::user()->tip == 0)
    <div role="main" class="main">
        <section class="page-header custom-product">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 center">
                        <p><h1 class="mb-none pb-none"><strong>Hesabınızı başarıyla oluşturdunuz.</strong></h1></p>
                        <p class="lead">Şimdi gerekli görülen diğer bilgilerinizi doldurmanız istenecektir.</p>
                        <p class="lead">Lütfen sistemimizi hangi amaçla kullanacağınızı aşağıdaki butonlara tıklayarak belirtiniz.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 center">
                        <form action="{{ url('/kullanici/tipDegistir') }}" method="POST" id="panelTip1" style="display: none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="tip" value="1">
                        </form>
                        <form action="{{ url('/kullanici/tipDegistir') }}" method="POST" id="panelTip2" style="display: none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="tip" value="2">
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('panelTip1').submit();" data-hash="" data-hash-offset="70" class="btn btn-primary btn-lg mb-xl"><i class="fa fa-globe"></i><i class="fa fa-money"></i> Anket Doldurarak Para Kazanan</a>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('panelTip2').submit();" data-hash="" data-hash-offset="70" class="btn btn-success btn-lg mb-xl"><i class="fa fa-globe"></i> Anket Yayınlamak İsteyen</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 center">
                        <h1 class="mb-none pb-none">Teşekkür Ederiz.</h1><br/>
                    </div>
                </div>

            </div>
        </section>
    </div>
    @else
        <div role="main" class="main">

            <div class="container">

                <div class="row">
                    <div class="col-md-12">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabs">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#popular" data-toggle="tab"><i class="fa fa-user"></i> Kullanıcı Bilgileri - Son Aşama</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="popular" class="tab-pane active">
                                            <p>
                                                    <?php
                                                    $onceki = "";
                                                    foreach ($sorular as $soru){
                                                        if($onceki != $soru->soru_id){
                                                           echo "<strong>$soru->soru_metni</strong>";
                                                        }
                                                        echo $FunctionController::secenekOlustur($soru->cevap_tipi,$soru->cevap_metni);

                                                    $onceki = $soru->soru_id;
                                                    }

                                                    ?>

                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            </div>

                    </div>

                </div>

            </div>

        </div>
    @endif

@endsection
