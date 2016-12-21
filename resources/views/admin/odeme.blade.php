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
                    @foreach($istekler as $i=>$istek)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $istek->name }}</td>
                        <td>{{ $istek->miktar }} TL</td>
                        <td>
                            @if($istek->tip==0) Ptt İsme Gönder
                            @else Banka Kartıma Gönder
                            @endif
                        </td>
                        <td>ELAZIĞ MERKEZ</td>
                        <td>Deneme</td>
                        <td>
                            <form name="red{{ $istek->id }}" method="post" action="{{ URL::to('admin/odeme/'.$istek->id) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="durum" value="1">
                                <textarea placeholder="İşlemi Red edecek iseniz nedenini yazınız" name="mesaj">@if($istek->durum==1){{ $istek->mesaj }}@endif</textarea>
                            </form>

                            <form name="onay{{ $istek->id }}" method="post" action="{{ URL::to('admin/odeme/'.$istek->id) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="durum" value="2">
                            </form>
                        </td>
                        <td>
                            @if($istek->durum==0)
                                <span class="badge bg-yellow">Bekliyor</span>
                            @elseif($istek->durum==1)
                                <span class="badge bg-red">Red Edildi</span>
                            @else
                                <span class="badge bg-green">Onaylandı</span>
                            @endif
                        </td>
                        <td>
                            @if($istek->durum==0 || $istek->durum==2)
                            <a onclick="red{{ $istek->id }}.submit()" class="btn btn-xs btn-danger" title="Red Et"><i class="fa fa-ban"></i></a>
                            @endif
                            @if($istek->durum==0 || $istek->durum==1)
                            <a onclick="onay{{ $istek->id }}.submit()" class="btn btn-xs btn-success" title="Onayla"><i class="fa fa-check"></i></a>
                             @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody></table>
                {{ $istekler->links() }}
            </div>
        </div>

    </div>
</div>

    </section>
@endsection