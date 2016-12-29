@extends('layouts.admin')
@section('content')
    <script src="{{ asset('template/vendor/ckeditor/ckeditor.js') }}"></script>
    <section class="content-header">
        <h1>
           Üye Soru Yönetimi
        </h1>
    </section>
    <section class="content">
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Sorular</h3>
            </div>
            <div class="box-body">
                <a class="btn btn-app" data-toggle="modal" data-target="#soruEkle">
                    <i class="fa fa-plus"></i> Yeni Soru Ekle
                </a>
                <div class="modal fade" id="soruEkle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Yeni Soru Ekle</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="{{ URL::to('admin/soru/create') }}" method="post" name="soruEkle" onsubmit="return false;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="GET">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Soru Metnini Yazınız</label>
                                            <input name="soru_metni" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Soru Tipini Seçiniz</label>
                                            <select name="soru_tipi" type="text" class="form-control">
                                                <option value="">Seçiniz</option>
                                                <option value="2">Anket Veren</option>
                                                <option value="1">Anket Dolduran</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Soru Seçenek Tipini Seçiniz</label>
                                            <select name="soru_secenek_tipi" type="text" class="form-control">
                                                <option value="">Seçiniz</option>
                                                <option value="2">Radio Buton</option>
                                                <option value="1">Seçim Kutusu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Seçenek Ekle</label>
                                            <button type="button" id="secenekEkle" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Ekle</button>
                                            <div id="soruSecenek"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                                <button type="button" class="btn btn-primary" onclick="soruEkle.submit()">Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-condensed">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Soru Metni</th>
                        <th>Soru Seçenekleri</th>
                        <th>Soru Tipi</th>
                        <th>İşlemler</th>
                    </tr>
                    @foreach($sorular as $soru)
                        <tr>
                            <td>{{ $soru->id }}</td>
                            <td>{{ $soru->soru_metni }}</td>
                            <td>{!! $FunctionController::soruSecenekleri($soru->id) !!}</td>
                            <td>
                                @if($soru->tip==2)
                                    Anket Veren
                                @else
                                    Anket Dolduran
                                @endif
                            </td>
                            <form name="sil{{ $soru->id }}" method="post" action="{{ URL::to('admin/soru/'.$soru->id) }}">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                            </form>                            <td>
                                <a href="#" style="display: none;" data-toggle="modal" data-target="#soruDuzenle" onclick="guncelle({{ $soru->id }})" class="btn btn-flat btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                <a href="#" onclick="sil{{ $soru->id }}.submit()" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody></table>
            </div>
        </div>

    </div>
</div>

    </section>

    <div class="modal fade" id="soruDuzenle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Soru Düzenle</h4>
                </div>
                <div class="modal-body">
                    <div id="soruLoading"></div>
                    <form id="soruDuzenle" role="form" action="{{ URL::to('admin/soru') }}" method="post" name="soruDuzenle">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="box-body">
                            <div class="form-group">
                                <label>Soru Metnini Yazınız</label>
                                <input id="soru_metni" name="soru_metni" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Soru Tipini Seçiniz</label>
                                <select name="soru_tipi" id="soru_tipi" type="text" class="form-control">
                                    <option value="">Seçiniz</option>
                                    <option value="2">Anket Veren</option>
                                    <option value="1">Anket Dolduran</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Soru Seçenek Tipini Seçiniz</label>
                                <select name="soru_secenek_tipi" id="soru_secenek_tipi" type="text" class="form-control">
                                    <option value="">Seçiniz</option>
                                    <option value="2">Radio Buton</option>
                                    <option value="1">Seçim Kutusu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Seçenek Ekle</label>
                                <button type="button" id="secenekEkle" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Ekle</button>
                                <div id="soruSecenek"></div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary" onclick="soruDuzenle.submit()">Güncelle</button>
                </div>
            </div>
        </div>
    </div>
<script>
    function guncelle(id){
        $('#soruLoading').show();
        $('#sssDuzenle').hide();
        $('#soruLoading').html('<center><img src="/template/img/progress-circle-master.svg"></center>');
        $.ajax({
            type:'POST',
            data:"_method=GET&id="+id,
            url:'{{ URL::to('admin/soru/') }}/'+id,
            success:function(gelen){
               $('#soruDuzenMetin').val(gelen.soru_metni);
                CKEDITOR.instances.soruDuzenCevap.setData( gelen.soru_cevabi );
                $('#soruLoading').hide();
                $('#sssDuzenle').show();
                $('#sssDuzenle').attr('action','{{ URL::to('admin/sss') }}/'+id);
            }
        });
    }
    $(document).ready(function () {
        var i = 0;
        $("#secenekEkle").click(function () {
            $("#soruSecenek").append("<div class='alert alert-info'>" +
                    "<label>Seçenek Metni</label>: <input class='form-control' type='text' name='secenek[]' placeholder='Seçenek Metnini Yazınız'>" +
                    "</div>");
        });
    });

    </script>
    <script>
        CKEDITOR.replace( 'soru_cevabi' );
        CKEDITOR.replace( 'soruDuzenCevap' );
    </script>
@endsection