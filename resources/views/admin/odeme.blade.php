@extends('layouts.admin')
@section('content')
    <script src="{{ asset('template/vendor/ckeditor/ckeditor.js') }}"></script>
    <section class="content-header">
        <h1>
            Ödeme İstekleri Yönetimi
        </h1>
    </section>
    <section class="content">
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Ödeme İstekleri</h3>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>İsim</th>
                        <th>Miktar</th>
                        <th>Aktarım Tipi</th>
                        <th>Banka İsmi/Ptt Şubesi</th>
                        <th>Banka İçin Iban/Ptt İçin Ek Bilgi</th>
                        <th>Red Mesajı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td>İbrahim Eraslan</td>
                        <td>210 TL</td>
                        <td>PTT Havale</td>
                        <td>ELAZIĞ MERKEZ</td>
                        <td>Deneme</td>
                        <td>
                            <textarea placeholder="İşlemi Red edecek iseniz nedenini yazınız"></textarea>
                        </td>
                        <td>
                            <span class="badge bg-red">Red Edildi</span>
                            <span class="badge bg-yellow">Bekliyor</span>
                            <span class="badge bg-green">Onaylandı</span>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-danger" title="Red Et"><i class="fa fa-ban"></i></a>
                            <a class="btn btn-xs btn-success" title="Onayla"><i class="fa fa-check"></i></a>
                        </td>
                    </tr>

                    </tbody></table>
            </div>
        </div>

    </div>
</div>

    </section>
@endsection