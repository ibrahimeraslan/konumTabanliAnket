@extends('layouts.app')
@section('content')
    <div role="main" class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-none">Ayarlarım</h2>
                    <p>Üyeliğinizle ilgili tüm işlemleri bu sayfadan yapabilir ve üyeliğinizi tamamen silebilirsiniz.</p>

                    <hr class="tall">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabs">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#anaBilgiler" data-toggle="tab" class="text-center"><i class="fa fa-user"></i> Ana Bilgilerim</a></li>
                            <li><a href="#ayrintiliBilgiler" data-toggle="tab" class="text-center"><i class="fa fa-edit"></i> Ayrıntılı Bilgilerim</a></li>
                            <li><a href="#sifreIslemleri" data-toggle="tab" class="text-center"><i class="fa fa-lock"></i> Şifre İşlemleri</a></li>
                            <li><a href="#hesapIslemleri" data-toggle="tab" class="text-center"><i class="fa fa-gear"></i> Hesap İşlemleri</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="anaBilgiler" class="tab-pane active">
                                <p>
                                 <form class="form-horizontal" role="form" autocomplete="off" method="post" enctype="multipart/form-data" action="{{ URL::to('kullanici/ayarlar/anaBilgiler') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="fname" class="col-sm-3 control-label">Mail Adresiniz</label>
                                        <div class="col-sm-9">
                                            <input type="text"  class="form-control" disabled value="{{ Auth::user()->email }}" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname" class="col-sm-3 control-label">Adınız</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="isim" required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname" class="col-sm-3 control-label">Doğum  Tarihiniz</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" value="{{ Auth::user()->dogum_tarihi }}" name="dtarihi" required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname" class="col-sm-3 control-label">Mesleğiniz</label>
                                        <div class="col-sm-9">
                                            <select name="meslek" class="form-control">
                                                <option value="">Seçiniz</option>
                                                @foreach($meslekler as $meslek)
                                                    <option @if(Auth::user()->meslek_id == $meslek->id) selected @endif value="{{ $meslek->id }}">{{ $meslek->meslek_adi }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname" class="col-sm-3 control-label">Avatarınız</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="avatar" aria-required="true"><br/>
                                            <img style="max-width: 100px; border:1px solid #c0c0c0; border-radius: 10px 10px 10px 10px;" src="{{ URL::to('img/avatar/'.Auth::user()->avatar) }}">
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
                                </p>
                            </div>
                            <div id="ayrintiliBilgiler" class="tab-pane">
                                <p>ayrintiliBilgiler</p>
                            </div>
                            <div id="sifreIslemleri" class="tab-pane">
                                <p>
                                <form method="post" class="form-horizontal" role="form" autocomplete="off" action="{{ URL::to('kullanici/ayarlar/sifreDegistir') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="fname" class="col-sm-3 control-label">Kullanımdaki Şifreniz</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="e_sifre" required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname" class="col-sm-3 control-label">Yeni Şifreniz</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password" required aria-required="true">
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
                                </p>
                            </div>
                            <div id="hesapIslemleri" class="tab-pane">
                                <p class="alert alert-danger">Sistem üzerindeki tüm işlemleriniz silinecektir. Daha önce oluşturduğunuz anketler veya cevaplar varsa bunlar silinecektir. Sistem üzerinde alacağınız varsa hesabınızı silmeniz durumunda artık hak edemeyeceksiniz. Bu işleminin bir geri dönüşü yoktur!<br/>Yinede hesabınızı silmek istiyor musunuz?
                                    <br/><br/><button class="btn btn-xs btn-primary"  data-toggle="modal" data-target=".hesapSil"><i class="fa fa-check"></i> Kabul ediyorum, Sil</button> <a href="{{ URL::to('kullanici/ayarlar') }}" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> Kabul etmiyorum, İptal</a>

                                <div class="modal fade hesapSil" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="gridSystemModalLabel">İşlem Onayı</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p class="alert alert-danger">Sistem üzerindeki tüm işlemleriniz silinecektir. Daha önce oluşturduğunuz anketler veya cevaplar varsa bunlar silinecektir. Sistem üzerinde alacağınız varsa hesabınızı silmeniz durumunda artık hak edemeyeceksiniz. Bu işleminin bir geri dönüşü yoktur!<br/>Yinede hesabınızı silmek istiyor musunuz?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ URL::to('kullanici/ayarlar/hesapSil/'.Auth::user()->email) }}" class="btn btn-primary"><i class="fa fa-check"></i> Kabul ediyorum, Sil</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Kabul etmiyorum, İptal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection