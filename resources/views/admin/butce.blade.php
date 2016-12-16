@extends('layouts.admin')
@section('content')
    <script src="{{ asset('template/vendor/ckeditor/ckeditor.js') }}"></script>
    <section class="content-header">
        <h1>
            Bütçe Yönetimi
        </h1>
    </section>
    <section class="content">
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Bütçe Bilgileri</h3>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-check-circle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Toplam Ödeme Adedi</span>
                                <span class="info-box-number">{{ $odeme }} <small>kez</small></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-calculator"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Toplam Ödeme</span>
                                <span class="info-box-number">
                                    @if($odemeToplam[0]->toplam == null)
                                        0
                                    @else
                                       {{ $odemeToplam[0]->toplam }}
                                    @endif
                                        TL</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-globe"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Toplam Anket</span>
                                <span class="info-box-number">{{ $anketSayisi }} <small>adet</small></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sistem Kazancı</span>
                                <span class="info-box-number">{{ $odemeToplam[0]->toplam * $ayarlar->ucret_kesintisi / 100 }} TL</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>


                <h4>Son sistem ödeme hareketleri</h4>
                <hr/>
                <table class="table table-condensed">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Üye</th>
                        <th>Miktar</th>
                        <th>Durum</th>
                    </tr>
                    @foreach($odemeler as $odeme)
                    <tr>
                        <td>1.</td>
                        <td>{{ $FunctionController::uyeBilgiIsim($odeme->user_id) }}</td>
                        <td>
                            {{ $odeme->miktar }} TL
                        </td>
                        <td>
                            @if($odeme->durum==0)
                                <span class="label label-warning">Kontrol Ediliyor</span>
                            @elseif($odeme->durum==1)
                                <span class="label label-danger">Red Edildi!, {{ $odeme->mesaj }}</span>
                            @elseif($odeme->durum==2)
                                <span class="label label-info">Aktarıldı</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody></table>
            </div>
        </div>

    </div>
</div>

    </section>
@endsection