@extends('layouts.admin')
@section('content')
    <script src="{{ asset('template/vendor/ckeditor/ckeditor.js') }}"></script>
    <section class="content-header">
        <h1>
           Anket Yönetimi
        </h1>
    </section>
    <section class="content">
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Anketler</h3>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Anket Adı</th>
                        <th>Oluşturan</th>
                        <th>Oluşturma Zamanı</th>
                        <th>Durumu</th>
                        <th>İşlemler</th>
                    </tr>
                    @foreach($anketler as $i=>$anket)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $anket->anket_adi }}</td>
                            <td>{{ $anket->name }}</td>
                            <td>{{ $anket->created_at }}</td>
                            <td>
                                @if($anket->anket_durum == 0)
                                <span class="badge bg-red">Pasif</span>
                                @else
                                <span class="badge bg-green">Aktif</span>
                                @endif
                            </td>
                            <form name="sil{{ $anket->id }}" method="post" action="{{ URL::to('admin/anket/'.$anket->id) }}">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                            </form>
                            <form name="onayla{{ $anket->id }}" method="post" action="{{ URL::to('admin/anket/'.$anket->id) }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="durum" value="2">
                                {{ csrf_field() }}
                            </form>
                            <form name="reddet{{ $anket->id }}" method="post" action="{{ URL::to('admin/anket/'.$anket->id) }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="durum" value="1">
                                {{ csrf_field() }}
                            </form>
                            <td>
                                @if($anket->anket_durum == 1)
                                <a href="#" onclick="reddet{{ $anket->id }}.submit()" class="btn btn-flat btn-xs btn-danger" title="Pasif et"><i class="fa fa-ban"></i></a>
                                @else
                                <a href="#" onclick="onayla{{ $anket->id }}.submit()" class="btn btn-flat btn-xs btn-success" title="Aktif et"><i class="fa fa-ban"></i></a>
                                @endif
                                <a href="#" onclick="sil{{ $anket->id }}.submit()" class="btn btn-flat btn-xs btn-danger" title="Anketi Sil"><i class="fa fa-remove"></i></a>
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