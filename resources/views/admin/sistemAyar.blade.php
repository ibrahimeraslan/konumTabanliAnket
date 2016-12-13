@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Sistem Ayarları
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
               <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sistem Ayarları</h3>
                    </div>
                    <form role="form" action="{{ URL::to('admin/sistemAyar') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label>Sitenizin İsmi</label>
                                <input name="site_adi" type="text" class="form-control" value="{{ $ayarlar->site_adi }}">
                            </div>
                            <div class="form-group">
                                <label>Sistem Ucret Kesintisi % Olarak</label>
                                <input name="ucret_kesintisi" type="text" class="form-control" value="{{ $ayarlar->ucret_kesintisi }}">
                            </div>
                            <div class="form-group">
                                <label>Sistem Para Aktarım Sınırı TL Olarak</label>
                                <input type="text" name="aktarim_siniri" class="form-control" value="{{ $ayarlar->aktarim_siniri }}">
                            </div>
                            <div class="form-group">
                                <label>Site Mail Adresi</label>
                                <input name="site_mail" type="text" class="form-control" value="{{ $ayarlar->site_mail }}">
                            </div>
                            <div class="form-group">
                                <label>Site Telefon Numarası</label>
                                <input type="text" name="site_tel" class="form-control" value="{{ $ayarlar->site_tel }}">
                            </div>
                            <div class="form-group">
                                <label>Site İçin Adres</label>
                                <textarea name="site_adres" class="form-control">{{ $ayarlar->site_adres }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Facebook Linki</label>
                                <input name="facebook" type="text" class="form-control" value="{{ $ayarlar->facebook }}">
                            </div>
                            <div class="form-group">
                                <label>Twitter Linki</label>
                                <input name="twitter" type="text" class="form-control" value="{{ $ayarlar->twitter }}">
                            </div>
                            <div class="form-group">
                                <label>Youtube Linki</label>
                                <input name="youtube" type="text" class="form-control" value="{{ $ayarlar->youtube }}">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
@endsection