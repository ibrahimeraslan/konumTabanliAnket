@extends('layouts.admin')
@section('content')
    <script src="{{ asset('template/vendor/ckeditor/ckeditor.js') }}"></script>
    <section class="content-header">
        <h1>
           Meslek Yönetimi
        </h1>
    </section>
    <section class="content">
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Meslekler</h3>
            </div>
            <div class="box-body">
                <a class="btn btn-app" data-toggle="modal" data-target="#soruEkle">
                    <i class="fa fa-plus"></i> Yeni Ekle
                </a>
                <div class="modal fade" id="soruEkle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Yeni Meslek Ekle</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="{{ URL::to('admin/meslek/create') }}" method="post" name="meslekEkle">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="GET">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Mesleği Yazınız</label>
                                            <input name="meslek_metni" type="text" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                                <button type="button" class="btn btn-primary" onclick="meslekEkle.submit()">Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-condensed">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Meslek</th>
                        <th style="width: 40px">İşlemler</th>
                    </tr>
                    @foreach($meslekler as $meslek)
                        <form name="sil{{ $meslek->id }}" method="post" action="{{ URL::to('admin/meslek/'.$meslek->id) }}">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}
                        </form>
                        <tr>
                            <td>{{ $meslek->id }}</td>
                            <td>{{ $meslek->meslek_adi }}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#meslekDuzenle" onclick="guncelle({{ $meslek->id }})" class="btn btn-flat btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                <a href="#" onclick="sil{{ $meslek->id }}.submit()" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody></table>
            </div>
        </div>

    </div>
</div>

    </section>

    <div class="modal fade" id="meslekDuzenle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Meslek Düzenle</h4>
                </div>
                <div class="modal-body">
                    <div id="soruLoading"></div>
                    <form id="meslekDuzenleForm" role="form" action="{{ URL::to('admin/meslek') }}" method="post" name="meslekDuzenle">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Mesleği Yazınız</label>
                                <input id="meslek_metni" name="meslek_metni" type="text" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary" onclick="meslekDuzenle.submit()">Güncelle</button>
                </div>
            </div>
        </div>
    </div>
<script>
    function guncelle(id){
        $('#soruLoading').show();
        $('#meslekDuzenleForm').hide();
        $('#soruLoading').html('<center><img src="/template/img/progress-circle-master.svg"></center>');
        $.ajax({
            type:'POST',
            data:"_method=GET&id="+id,
            url:'{{ URL::to('admin/meslek/') }}/'+id,
            success:function(gelen){
               $('#meslek_metni').val(gelen.meslek_adi);
                $('#soruLoading').hide();
                $('#meslekDuzenleForm').show();
                $('#meslekDuzenleForm').attr('action','{{ URL::to('admin/meslek') }}/'+id);
            }
        });
    }
    </script>
@endsection