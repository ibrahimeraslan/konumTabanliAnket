@extends('layouts.admin')
@section('content')
    <script src="{{ asset('template/vendor/ckeditor/ckeditor.js') }}"></script>
    <section class="content-header">
        <h1>
            Gösterge Paneli
        </h1>
    </section>
    <section class="content">
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Bilgiler</h3>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Anket Veren Kullanıcı</span>
                                <span class="info-box-number">{{ $anketVeren }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Anket Dolduran Kullanıcı</span>
                                <span class="info-box-number">{{ $anketDolduran }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sistem Admin Erişimi</span>
                                <span class="info-box-number">{{ $admin }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>


                <h4>Son sistem anket hareketleri</h4>
                <hr/>
                <table class="table table-condensed">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Anket Adı</th>
                        <th>Yayınlayan</th>
                        <th>Anket Limiti</th>
                        <th>Anket Katılım Sayısı</th>
                    </tr>
                    @foreach($sonAnketler as $i=>$sonAnket)
                    <tr>
                        <td>{{ $i+1}}</td>
                        <td>{{ $sonAnket->anket_adi }}</td>
                        <td>{{ $sonAnket->name }}</td>
                        <td>{{ $sonAnket->anket_limit }}</td>
                        <td>{{ $sonAnket->anket_katilim_sayisi }}</td>
                    </tr>
                    @endforeach
                    </tbody></table>
            </div>
        </div>

    </div>
</div>

    </section>
@endsection