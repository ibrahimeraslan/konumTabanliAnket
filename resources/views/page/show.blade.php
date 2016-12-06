@extends('layouts.app')
@section('content')
    <div role="main" class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <aside class="sidebar">
                        <div class="clearfix"></div>
                        <h4 class="heading-primary">Hızlı Erişim</h4>
                        <ul class="nav nav-list mb-xlg">
                            <li><a href="{{ URL::to('/') }}">Anasayfa</a></li>
                            @foreach($sayfalar as $sayfa)
                                <li class="dropdown"><a href="{{ URL::to('page/show/'.$sayfa->id) }}">{{ $sayfa->sayfa_adi }}</a></li>
                            @endforeach
                            <li><a href="{{ URL::to('page/sss') }}">Sık Sorulan Sorular</a></li>
                            <li><a href="{{ URL::to('page/iletisim') }}">İletişim</a></li>
                        </ul>
                        <h4 class="heading-primary">Trpoll</h4>
                        <p><a href="{{ URL::to('register') }}"><img src="{{ asset('template/img/left/anket.png') }}" style="width: 100%;"></a></p>
                        <p><a href="{{ URL::to('register') }}"><img src="{{ asset('template/img/left/paypal.png') }}" style="width: 100%;"></a></p>
                        <p><a href="{{ URL::to('register') }}"><img src="{{ asset('template/img/left/firma.png') }}" style="width: 100%;"></a></p>
                    </aside>
                </div>
                <div class="col-md-9">

                    <h2>{{ $sayfaBilgileri->sayfa_adi }}</h2>

                    <hr/>

                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                {{ $sayfaBilgileri->sayfa_metni }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection