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
                    @foreach($uyeler as $i=>$uye)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td><img style="max-width:40px; height:auto; border-radius: 100%" src="{{ asset('img/avatar/'.$uye->avatar) }}"></td>
                        <td>{{ $uye->name }}</td>
                        <td>{{ $uye->email }}</td>
                        <td>
                            @if($uye->is_admin == 1)
                            <span class="badge bg-red">Admin</span>
                            @else
                            <span class="badge bg-green">Üye</span>
                            @endif
                        </td>
                        <td>
                            @if($uye->tip == 2)
                            <span class="badge bg-red">Anket Veren</span>
                            @else
                            <span class="badge bg-green">Anket Dolduran</span>
                            @endif
                        </td>
                        <form name="sil{{ $uye->id }}" method="post" action="{{ URL::to('admin/uye/'.$uye->id) }}">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}
                        </form>
                        <form name="adminle{{ $uye->id }}" method="post" action="{{ URL::to('admin/uye/'.$uye->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="yetki" value="2">
                            {{ csrf_field() }}
                        </form>
                        <form name="uyele{{ $uye->id }}" method="post" action="{{ URL::to('admin/uye/'.$uye->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="yetki" value="1">
                            {{ csrf_field() }}
                        </form>
                        <td>
                            @if($uye->is_admin == 0)
                            <a onclick="adminle{{ $uye->id }}.submit()" class="btn btn-xs btn-warning" title="Admin Yetkisi Ver"><i class="fa  fa-star"></i></a>
                            @else
                            <a onclick="uyele{{ $uye->id }}.submit()" class="btn btn-xs btn-warning" title="Üye Yetkisi Ver"><i class="fa  fa-star-o"></i></a>
                            @endif
                            <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#uyeBilgileri" onclick="uyeBilgi({{ $uye->id }})" title="Üye Detayları"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-xs btn-danger" onclick="sil{{ $uye->id }}.submit()" title="Üyeyi Sil"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody></table>
            </div>
        </div>

    </div>
</div>

    </section>

    <div class="modal fade" id="uyeBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Üye Bilgileri</h4>
                </div>
                <div class="modal-body">
                    <div id="uyeLoading"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
<script>
    function uyeBilgi(id){
        $('#uyeLoading').html('<center><img src="/template/img/progress-circle-master.svg"></center>');
        $.ajax({
            type:'POST',
            data:"_method=GET&id="+id,
            url:'{{ URL::to('admin/uye/') }}/'+id,
            success:function(gelen){
                $('#uyeLoading').html(gelen);
            }
        });
    }
</script>
@endsection