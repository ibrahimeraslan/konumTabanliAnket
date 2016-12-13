@extends('layouts.admin')
@section('content')
    <script src="{{ asset('template/vendor/ckeditor/ckeditor.js') }}"></script>
    <section class="content-header">
        <h1>
           Sistem Sayfaları Yönetimi
        </h1>
    </section>
    <section class="content">
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Sayfalar</h3>
            </div>
            <div class="box-body">
                <a class="btn btn-app" data-toggle="modal" data-target="#soruEkle">
                    <i class="fa fa-plus"></i> Yeni Sayfa Ekle
                </a>
                <div class="modal fade" id="soruEkle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Yeni Sayfa Ekle</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="{{ URL::to('admin/sss/create') }}" method="post" name="sssEkle">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="GET">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Sayfa Adını Yazınız</label>
                                            <input name="soru_metni" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Sayfa Metnini Yazınız</label>
                                            <input name="soru_metni" type="text" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                                <button type="button" class="btn btn-primary" onclick="sssEkle.submit()">Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-condensed">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Sayfa Adı</th>
                        <th>Sayfa Metni</th>
                        <th>İşlemler</th>
                    </tr>
                        <tr>
                            <td>1</td>
                            <td>Deneme Sayfası</td>
                            <td>Deneme Metni</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#soruDuzenle" onclick="guncelle()" class="btn btn-flat btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                <a href="#" onclick="sil.submit()" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
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
                    <h4 class="modal-title" id="myModalLabel">Sayfa Düzenle</h4>
                </div>
                <div class="modal-body">
                    <div id="soruLoading"></div>
                    <form id="sssDuzenle" role="form" action="{{ URL::to('admin/sss') }}" method="post" name="sssDuzenle">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Mesleği Yazınız</label>
                                <input id="soruDuzenMetin" name="soruDuzenMetin" type="text" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary" onclick="sssDuzenle.submit()">Güncelle</button>
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
            url:'{{ URL::to('admin/sss/') }}/'+id,
            success:function(gelen){
               $('#soruDuzenMetin').val(gelen.soru_metni);
                CKEDITOR.instances.soruDuzenCevap.setData( gelen.soru_cevabi );
                $('#soruLoading').hide();
                $('#sssDuzenle').show();
                $('#sssDuzenle').attr('action','{{ URL::to('admin/sss') }}/'+id);
            }
        });
    }
    </script>
    <script>
        CKEDITOR.replace( 'soru_cevabi' );
        CKEDITOR.replace( 'soruDuzenCevap' );
    </script>
@endsection