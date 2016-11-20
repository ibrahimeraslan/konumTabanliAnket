@extends('layouts.app')

@section('content')
    <?php
    $toplam = 0;
    foreach($dAnketler as $anket){
        if($anket->durum==2) $toplam = $toplam + $anket->anket_ucret;
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-none"><b>{{ ucwords(Auth::user()->name) }}</b> <a class="btn btn-xs btn-tertiary " @if($toplam<$ayarlar->aktarim_siniri) disabled @endif><i class="fa fa-globe"></i> Kazancımı Hesabıma Aktar</a></h2>
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
                                        {{ $anket->anket_ucret }} <i class="fa fa-try"></i>
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
                        <div id="sifreIslemleri" class="tab-pane">
                            <p>
                            </p><form method="post" class="form-horizontal" role="form" autocomplete="off" action="http://localhost:8000/kullanici/ayarlar/sifreDegistir">
                                <input type="hidden" name="_token" value="kN55yQlxoLtKTgt55c5n5qWVm6xGUFpdjA8iyKri">
                                <div class="form-group">
                                    <label for="fname" class="col-sm-3 control-label">Kullanımdaki Şifreniz</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="e_sifre" required="" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fname" class="col-sm-3 control-label">Yeni Şifreniz</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" required="" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fname" class="col-sm-3 control-label">Tekrar Yeni Şifreniz</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password_confirmation" aria-required="true">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Güncelle</button>
                                        <button class="btn btn-danger"><i class="pg-close"></i> Temizle</button>
                                    </div>
                                </div>
                            </form>
                            <p></p>
                        </div>
                        <div id="hesapIslemleri" class="tab-pane">
                            <p class="alert alert-danger">Sistem üzerindeki tüm işlemleriniz silinecektir. Daha önce oluşturduğunuz anketler veya cevaplar varsa bunlar silinecektir. Sistem üzerinde alacağınız varsa hesabınızı silmeniz durumunda artık hak edemeyeceksiniz. Bu işleminin bir geri dönüşü yoktur!<br>Yinede hesabınızı silmek istiyor musunuz?
                                <br><br><button class="btn btn-xs btn-primary" data-toggle="modal" data-target=".hesapSil"><i class="fa fa-check"></i> Kabul ediyorum, Sil</button> <a href="http://localhost:8000/kullanici/ayarlar" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> Kabul etmiyorum, İptal</a>

                            </p><div class="modal fade hesapSil" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title" id="gridSystemModalLabel">İşlem Onayı</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p class="alert alert-danger">Sistem üzerindeki tüm işlemleriniz silinecektir. Daha önce oluşturduğunuz anketler veya cevaplar varsa bunlar silinecektir. Sistem üzerinde alacağınız varsa hesabınızı silmeniz durumunda artık hak edemeyeceksiniz. Bu işleminin bir geri dönüşü yoktur!<br>Yinede hesabınızı silmek istiyor musunuz?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="http://localhost:8000/kullanici/ayarlar/hesapSil/eraslan.07@gmail.com" class="btn btn-primary"><i class="fa fa-check"></i> Kabul ediyorum, Sil</a>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Kabul etmiyorum, İptal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
