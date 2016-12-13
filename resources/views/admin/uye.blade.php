@extends('layouts.admin')
@section('content')
    <script src="{{ asset('template/vendor/ckeditor/ckeditor.js') }}"></script>
    <section class="content-header">
        <h1>
            Üye Yönetimi
        </h1>
    </section>
    <section class="content">
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Üyeler</h3>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Avatar</th>
                        <th>İsim</th>
                        <th>Mail</th>
                        <th>Yetki</th>
                        <th>Tip</th>
                        <th>İşlemler</th>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td><img src=""></td>
                        <td>İbrahim Eraslan</td>
                        <td>eraslan.07@gmail.com</td>
                        <td>
                            <span class="badge bg-red">Admin</span>
                            <span class="badge bg-green">Üye</span>
                        </td>
                        <td>
                            <span class="badge bg-red">Anket Veren</span>
                            <span class="badge bg-green">Anket Dolduran</span>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-warning" title="Admin Yetkisi Ver"><i class="fa  fa-star"></i></a>
                            <a class="btn btn-xs btn-warning" title="Üye Yetkisi Ver"><i class="fa  fa-star-o"></i></a>
                            <a class="btn btn-xs btn-info" title="Üye Detayları"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-xs btn-danger" title="Üyeyi Sil"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>

                    </tbody></table>
            </div>
        </div>

    </div>
</div>

    </section>
@endsection