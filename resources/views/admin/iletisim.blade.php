@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            İletişim Mesajları Yönetimi
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
               <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">İletişim Mesajları</h3>
                    </div>
                   <table class="table table-condensed">
                       <tbody><tr>
                           <th style="width: 10px">#</th>
                           <th>İsim</th>
                           <th>Mail</th>
                           <th>Konu</th>
                           <th>Mesaj</th>
                           <th>Zaman</th>
                           <th>Durum</th>
                           <th style="width: 40px">İşlemler</th>
                       </tr>
                       @foreach($mesajlar as $mesaj)
                       <tr>
                           <td>{{ $mesaj->id }}</td>
                           <td>{{ $mesaj->isim }}</td>
                           <td>{{ $mesaj->mail }}</td>
                           <td>{{ $mesaj->konu }}</td>
                           <td>{{ $mesaj->mesaj }}</td>
                           <td>{{ $mesaj->created_at }}</td>
                           <td>
                               @if($mesaj->durum == 0)
                               <span class="badge bg-red">Okunmadı</span>
                               @else
                               <span class="badge bg-green">Okundu</span>
                               @endif
                           </td>
                           <form name="sil{{ $mesaj->id }}" method="post" action="{{ URL::to('admin/iletisim/'.$mesaj->id) }}">
                               <input type="hidden" name="_method" value="DELETE">
                               {{ csrf_field() }}
                           </form>
                           <form name="guncelle{{ $mesaj->id }}" method="post" action="{{ URL::to('admin/iletisim/'.$mesaj->id) }}">
                               <input type="hidden" name="_method" value="PUT">
                               {{ csrf_field() }}
                           </form>
                           <td>
                               @if($mesaj->durum==1)
                               <a href="#" onclick="guncelle{{ $mesaj->id }}.submit()" class="btn btn-flat btn-xs btn-success"><i class="fa fa-check"></i></a>
                                @endif
                               <a href="#" onclick="sil{{ $mesaj->id }}.submit()" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-remove"></i></a>
                           </td>
                       </tr>
                           @endforeach
                       </tbody></table>

                </div>

            </div>

        </div>
@endsection