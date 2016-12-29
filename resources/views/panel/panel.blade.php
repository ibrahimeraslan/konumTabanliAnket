@extends('layouts.app')
@if($tip==1)
@section('content')
    <?php
    $toplam = 0;
    foreach($dAnketler as $anket){
        if($anket->durum==2) $toplam = $toplam + $anket->anket_ucret;
    }
    $toplam = $toplam-($toplam*($ayarlar->ucret_kesintisi/100));
    $toplam = $toplam - $toplamPara[0]->toplam;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-none"><b>{{ ucwords(Auth::user()->name) }}</b> <button class="btn btn-xs btn-tertiary " @if($toplam<$ayarlar->aktarim_siniri) disabled @else data-toggle="modal" data-target="#moneyTransfer" @endif><i class="fa fa-globe"></i> Kazancımı Hesabıma Aktar</button></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <section class="section section-primary mb-none">
                        <div class="container">
                            <div class="row">
                                <div class="counters counters-text-light">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="counter">
                                            <strong data-to="{{ $toplam }}" data-append=" &#x20ba;">0</strong>
                                            <label>Kazancınız</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <div class="counter">
                                            <strong data-to="{{ $ayarlar->aktarim_siniri }}" data-append=" &#x20ba;">0</strong>
                                            <label>Aktarım Sınırı</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <div class="counter">
                                            <strong data-to="{{ $ayarlar->ucret_kesintisi }}" data-append="%">0</strong>
                                            <label>Sistem Kesintisi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <div class="counter">
                                            <strong data-to="{{ $aktifAnket }}">0</strong>
                                            <label>Aktif Anket</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <div class="counter">
                                            <strong data-to="{{ count($dAnketler) }}">0</strong>
                                            <label>Katılınan Anket</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
<hr/>
                <div class="tabs">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#kAnketler" data-toggle="tab" class="text-center"><i class="fa fa-user"></i> Katılabileceğim Anketler</a></li>
                        <li><a href="#kaAnketler" data-toggle="tab" class="text-center"><i class="fa fa-edit"></i> Katıldığım Anketler</a></li>
                        <li><a href="#pAktarim" data-toggle="tab" class="text-center"><i class="fa fa-money"></i> Para Aktarım İsteklerim</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="kAnketler" class="tab-pane active">

                        </div>
                        <div id="kaAnketler" class="tab-pane">
                            <h4>Katıldığım Anketler</h4>
                            @if(count($dAnketler)<1)
                                <div class="alert alert-warning">
                                    Henüz doldurmuş olduğunuz anket yok.
                                </div>
                                @else
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Anket İsmi
                                    </th>
                                    <th>
                                        Anket Tutari
                                    </th>
                                    <th>
                                        Tarih
                                    </th>
                                    <th>
                                        Durum
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dAnketler as $anket)
                                <tr>
                                    <td>
                                        {{ $anket->id }}
                                    </td>
                                    <td>
                                        {{ $anket->anket_adi }}
                                    </td>
                                    <td>
                                        {{ $anket->anket_ucret-($anket->anket_ucret*($ayarlar->ucret_kesintisi/100)) }} <i class="fa fa-try"></i>
                                    </td>
                                    <td>
                                        {{ $anket->created_at }}
                                    </td>
                                    <td>
                                        @if($anket->durum==0)
                                            <span class="label label-warning">Kontrol Ediliyor</span>
                                        @elseif($anket->durum==1)
                                            <span class="label label-danger">Red Edildi!</span>
                                        @elseif($anket->durum==2)
                                            <span class="label label-tertiary">Onaylandı</span>
                                        @endif
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                @endif
                        </div>
                        <div id="pAktarim" class="tab-pane">
                            <h4>Para Aktarım İsteklerim</h4>
                            @if(count($pIstekler)<1)
                                <div class="alert alert-warning">
                                    Henüz para aktarım isteğiniz yok.
                                </div>
                            @else
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>
                                            Miktar
                                        </th>
                                        <th>
                                            Gönderim Tercihi
                                        </th>
                                        <th>
                                            Ptt Şube / Banka İsmi
                                        </th>
                                        <th>
                                            Iban / Ptt Ek Bilgi
                                        </th>
                                        <th>
                                            Durum
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pIstekler as $pIstek)
                                        <tr>
                                            <td>
                                                {{ $pIstek->miktar }} <i class="fa fa-try"></i>
                                            </td>
                                            <td>
                                                @if($pIstek->tip == 0)
                                                    Ptt İsme Gönderim
                                                @else
                                                    Banka Kartına Gönderim
                                                @endif
                                            </td>
                                            <td>
                                               {{ $pIstek->isim }}
                                            </td>
                                            <td>
                                                {{ $pIstek->bilgi }}
                                            </td>
                                            <td>
                                                @if($pIstek->durum==0)
                                                    <span class="label label-warning">Kontrol Ediliyor</span>
                                                @elseif($pIstek->durum==1)
                                                    <span class="label label-danger">Red Edildi!, <b>{{ $pIstek->mesaj }}</b></span>
                                                @elseif($pIstek->durum==2)
                                                    <span class="label label-tertiary">Aktarıldı</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="moneyTransfer" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="largeModalLabel">Kazancımı Hesabıma Aktar</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-info">
                        Bu alandan kazancınızın hesabınıza aktarılmasını isteyebilirsiniz. Banka hesabınıza yada ptt üzerinden para aktarımı isteyebilirsiniz. Hesabınızdan aktarım başvurunuzun durumunu izleyebilir ve katip edebilirsiniz.<br/>
                        <b>Sistemdeki hesabınızda kullandığınız ad ve soyadınız ile para aktarmak istediğiniz hesabınızın bilgileri aynı olmak zorundadır.</b>
                    </p>
                    <p>
                    <form class="form-horizontal form-bordered" method="post" action="{{ URL::to('kullanici/paraTransfer') }}" name="paraTransfer" id="paraTransfer">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Aktarım Miktarı(TRY) *</label>
                            <div class="col-md-9">
                                <input type="number" name="miktar" min="{{ $ayarlar->aktarim_siniri }}" value="{{ $ayarlar->aktarim_siniri }}" class="form-control" id="inputDefault">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault1">Aktarım Miktarı(TRY) *</label>
                            <div class="col-md-9">
                                <select name="tip" class="form-control" id="inputDefault1">
                                    <option value="0">Ptt İsme Gönder</option>
                                    <option value="1">Banka Kartıma Gönder</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault2">Banka İsmi/Ptt Şubesi *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="isim" id="inputDefault2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault3">Banka İçin Iban/Ptt İçin Ek Bilgi</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="bilgi" id="inputDefault3"></textarea>
                            </div>
                        </div>
                    </form>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="paraTransfer.submit()">Başvurumu Yap</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@elseif($tip==2)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-none"><b>{{ ucwords(Auth::user()->name) }}</b> <a href="{{ URL::to('kullanici/anketOlustur') }}" target="_blank" class="btn btn-sm btn-tertiary">Yeni Anket Oluştur</a></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <section class="section section-primary mb-none">
                    <div class="container">
                        <div class="row">
                            <div class="counters counters-text-light">
                                <div class="col-md-3 col-sm-6">
                                    <div class="counter">
                                        <strong data-to="{{ count($anketler) }}">0</strong>
                                        <label>Oluşturduğum Anket</label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="counter">
                                        <strong data-to="{{ $toplamKatilim }}">0</strong>
                                        <label>Toplam Katılım</label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="counter">
                                        <strong data-to="{{ $ayarlar->ucret_kesintisi }}" data-append="%">0</strong>
                                        <label>Sistem Kesintisi</label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="counter">
                                        <strong data-to="{{ $uyeASayisi }}">0</strong>
                                        <label>Anket Yayınlayıcısı</label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="counter">
                                        <strong data-to="{{ $uyeSayisi }}">0</strong>
                                        <label>Sistem Kullanıcısı</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <hr/>
                <div class="tabs">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#kAnketler" data-toggle="tab" class="text-center"><i class="fa fa-user"></i> Oluşturmuş Olduğum Anketler</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="anketlerim" class="tab-pane active">
                            <h4>Oluşturduğum Anketlerim</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Anket Adı
                                    </th>
                                    <th>
                                        Katılım Limiti
                                    </th>
                                    <th>
                                        Doldurma Başına Ücret
                                    </th>
                                    <th>
                                        Katılmış Kişi Sayısı
                                    </th>
                                    <th>
                                        Anket Durumu
                                    </th>
                                    <th>
                                        Anket İşlemleri
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($anketler as $anket)
                                <tr>
                                    <td>
                                        {{ $anket->id }}
                                    </td>
                                    <td>
                                        {{ $anket->anket_adi }}
                                    </td>
                                    <td>
                                        {{ $anket->anket_limit }}
                                    </td>
                                    <td>
                                        {{ $anket->anket_ucret }} <i class="fa fa-try"></i>
                                    </td>
                                    <td>
                                        {{ $anket->anket_katilim_sayisi }}
                                    </td>
                                    <td>
                                        @if($anket->anket_durum==0)
                                            <span class="label label-danger">Yayında Değil</span>
                                        @elseif($anket->anket_durum==1)
                                            <span class="label label-tertiary">Yayında</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('kullanici/anket/gizliSoru/'.$anket->id) }}" data-toggle="tooltip" data-plugin-tooltip="" alt="Gizli Soru İşlemleri" title="Gizli Soru İşlemleri" class="btn btn-xs btn-primary "><i class="fa fa-shield"></i></a>
                                        <a href="{{ URL::to('kullanici/anket/anketBilgiDuzenle/'.$anket->id) }}" data-toggle="tooltip" data-plugin-tooltip="" alt="Düzenle" title="Düzenle" class="btn btn-xs btn-primary "><i class="fa fa-edit"></i></a>
                                        <a href="{{ URL::to('kullanici/anket/ayrintiGoster/'.$anket->id) }}" data-toggle="tooltip" data-plugin-tooltip="" alt="Ayrıntıları Görüntüle" title="Ayrıntıları Görüntüle" class="btn btn-xs btn-primary  "><i class="fa fa-bar-chart"></i></a>
                                        <a href="{{ URL::to('kullanici/anket/cevapGoster/'.$anket->id) }}" data-toggle="tooltip" data-plugin-tooltip="" alt="Cevaplar" title="Cevaplar" class="btn btn-xs btn-primary "><i class="fa fa-users"></i></a>
                                        @if($anket->anket_durum==1)
                                            <a href="{{ URL::to('kullanici/anket/anketDurumu/0/'.$anket->id) }}" data-toggle="tooltip" data-plugin-tooltip="" alt="Yayından Kaldır" title="Yayından Kaldır" class="btn btn-xs btn-secondary"><i class="fa fa-eye-slash"></i></a>
                                        @else
                                            <a href="{{ URL::to('kullanici/anket/anketDurumu/1/'.$anket->id) }}" data-toggle="tooltip" data-plugin-tooltip="" alt="Yayına Al" title="Yayına Al" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endif