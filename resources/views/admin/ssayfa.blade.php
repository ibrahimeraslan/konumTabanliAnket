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
                                <form role="form" action="{{ URL::to('admin/ssayfa/create') }}" method="post" name="ssayfaEkle">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="GET">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Sayfa Adını Yazınız</label>
                                            <input name="ssayfa_adi" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Sayfa Metnini Yazınız</label>
                                            <textarea name="ssayfa_metni" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                                <button type="button" class="btn btn-primary" onclick="ssayfaEkle.submit()">Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-condensed">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Sayfa Adı</th>
                        <th>Sayfa Metni(Önizleme)</th>
                        <th>İşlemler</th>
                    </tr>
                    @foreach($sayfalar as $i=>$sayfa)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $sayfa->sayfa_adi }}</td>
                            <td>{{ substr(strip_tags($sayfa->sayfa_metni),0,150) }}</td>
                            <td>
                                <form name="sil{{ $sayfa->id }}" method="post" action="{{ URL::to('admin/ssayfa/'.$sayfa->id) }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {{ csrf_field() }}
                                </form>
                                <a href="#" data-toggle="modal" data-target="#divssayfaDuzenle" onclick="guncelle({{ $sayfa->id }})" class="btn btn-flat btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                <a href="#" onclick="sil{{ $sayfa->id }}.submit()" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody></table>
            </div>
        </div>

    </div>
</div>

    </section>

    <div class="modal fade" id="divssayfaDuzenle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Sayfa Düzenle</h4>
                </div>
                <div class="modal-body">
                    <div id="ssayfaLoading"></div>
                    <form id="ssayfaDuzenle" role="form" action="{{ URL::to('admin/sss') }}" method="post" name="ssayfaDuzenle">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Sayfa Adını Yazınız</label>
                                <input id="ssayfaadiDuzenle" name="ssayfaadiDuzenle" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Sayfa Metnini Yazınız</label>
                                <textarea name="ssayfametniDuzenle" id="ssayfametniDuzenle" class="form-control"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary" onclick="ssayfaDuzenle.submit()">Güncelle</button>
                </div>
            </div>
        </div>
    </div>
<script>
    function guncelle(id){
        $('#ssayfaLoading').show();
        $('#ssayfaDuzenle').hide();
        $('#ssayfaLoading').html('<center><img src="/template/img/progress-circle-master.svg"></center>');
        $.ajax({
            type:'POST',
            data:"_method=GET&id="+id,
            url:'{{ URL::to('admin/ssayfa/') }}/'+id,
            success:function(gelen){
               $('#ssayfaadiDuzenle').val(gelen.sayfa_adi);
               $('#ssayfametniDuzenle').val(gelen.sayfa_metni);
                if(CKEDITOR.instances.ssayfametniDuzenle){
                    CKEDITOR.instances.ssayfametniDuzenle.destroy(true);
                }
                CKEDITOR.replace( 'ssayfametniDuzenle' );
                $('#ssayfaLoading').hide();
                $('#ssayfaDuzenle').show();
                $('#ssayfaDuzenle').attr('action','{{ URL::to('admin/ssayfa') }}/'+id);
            }
        });
    }
    </script>
    <script>
        CKEDITOR.replace( 'ssayfa_metni' );
    </script>
@endsection