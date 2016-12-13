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
                        <tr>
                            <td>1</td>
                            <td>Deneme Anketi</td>
                            <td>İbrahim Eraslan</td>
                            <td>12.12.2016 23.53</td>
                            <td>
                                <span class="badge bg-red">Pasif</span>
                                <span class="badge bg-green">Aktif</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-flat btn-xs btn-danger" title="Pasif et"><i class="fa fa-ban"></i></a>
                                <a href="#" class="btn btn-flat btn-xs btn-success" title="Aktif et"><i class="fa fa-ban"></i></a>
                                <a href="#" class="btn btn-flat btn-xs btn-danger" title="Anketi Sil"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                    </tbody></table>
            </div>
        </div>

    </div>
</div>

    </section>

@endsection