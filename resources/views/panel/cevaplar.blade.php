@extends('layouts.app')
@section('content')
    <div class="container">
<h4>{{ $anket->anket_adi }} için cevaplar</h4>
        @if($anketCevaplari=="")
            <div class="alert alert-danger">
                Henüz Kimse Anketi Cevaplamamış
                </div>
        @else
    <table class="table table-hover">
        <thead>
        <tr>
            <th>
                Avatar
            </th>
            <th>
                Üye İsmi
            </th>
            <th>
               Doldurma Zamanı
            </th>
            <th>
                Cevap Durumu
            </th>
            <th>
                Gizli Soru Durumu
            </th>
            <th>
                Cevap İşlemleri
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($dAnket as $kisi)
            <tr>
                <td>
                  <img src="{{ URL::to('img/avatar/'.$kisi->avatar) }}" style="width: 47px; height:57px;">
                </td>
                <td>
                {{ $kisi->name }}
                </td>
                <td>
                    {{ $kisi->created_at }}
                </td>
                <td>
                    @if($kisi->durum==0)
                        <span class="label label-warning">Kontrol Ediliyor</span>
                    @elseif($kisi->durum==1)
                        <span class="label label-danger">Red Edildi!</span>
                    @elseif($kisi->durum==2)
                        <span class="label label-tertiary">Onaylandı</span>
                    @endif
                </td>
                <td>
                    @php
                        $gizliSonuc = $FunctionController::gizliSonuc($kisi->id,$aid)
                    @endphp

                    @if($gizliSonuc==-1)
                        <span class="label label-warning">Gizli Sorusuz Anket</span>
                    @elseif($gizliSonuc==0)
                     <span class="label label-tertiary">Doğrulandı</span>
                      @else
                      <span class="label label-danger">{{ $gizliSonuc }} Geçersiz Cevap</span>
                      @endif
                </td>
                <form name="cevap2{{ $kisi->did }}" action="{{ URL::to('kullanici/anket/cevapDurumla') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $kisi->did }}" name="cAnket">
                    <input type="hidden" value="2" name="cDurum">
                </form>
                <form name="cevap1{{ $kisi->did }}" action="{{ URL::to('kullanici/anket/cevapDurumla') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $kisi->did }}" name="cAnket">
                    <input type="hidden" value="1" name="cDurum">
                </form>
                <form name="cevapGoster{{ $kisi->did }}" action="{{ URL::to('kullanici/anket/cevapGoster') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $kisi->did }}" name="dAnket">
                    <input type="hidden" value="{{ $aid }}" name="anketId">
                    <input type="hidden" value="{{ $kisi->id }}" name="dKisi">
                </form>
                <td>
                    <a onclick="cevap2{{ $kisi->did }}.submit()" data-toggle="tooltip" data-plugin-tooltip="" alt="Onayla" title="Onayla" class="btn btn-xs btn-success "><i class="fa fa-check"></i></a>
                    <a onclick="cevap1{{ $kisi->did }}.submit()" data-toggle="tooltip" data-plugin-tooltip="" alt="Reddet" title="Reddet" class="btn btn-xs btn-danger "><i class="fa fa-remove"></i></a>
                    <a onclick="cevapGoster{{ $kisi->did }}.submit()" data-toggle="tooltip" data-plugin-tooltip="" alt="Cevaplarını Gör" title="Cevaplarını Gör" class="btn btn-xs btn-primary "><i class="fa fa-list"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        @endif
    </div>
@endsection