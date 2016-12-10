@extends('layouts.app')
@section('content')
    <div role="main" class="main">
        <div class="container">

            <section class="page-not-found">
                <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                        <div class="page-not-found-main">
                            <h2>404 <i class="fa fa-file"></i></h2>
                            <p>Ulaşmaya Çalıştığınız Sayfa Bulunamadı.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="heading-primary">Bu sorunu her zaman yaşadığınızı düşünüyorsanız veya bu hatanın olmaması gerektiğine inanıyorsanız lütfen iletişim bölümünden bizimle irtibata geçiniz.<br>Anlayışınız ve değerli görüşleriniz için teşekkür ederiz.</h4>
                        <ul class="nav nav-list">
                            <li><a href="{{ URL::to('/') }}">Anasayfa</a></li>
                            <li><a href="{{ URL::to('/iletisim') }}">İletişim</a></li>
                        </ul>
                    </div>
                </div>
            </section>

        </div>

    </div>
@endsection