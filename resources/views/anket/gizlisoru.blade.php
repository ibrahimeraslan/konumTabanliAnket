@extends('layouts.app')
@section('content')
    <script src="{{ asset('template/vendor/ckeditor/ckeditor.js') }}"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>"{{ $anket->anket_adi }}" için gizli soru işlemleri</h4>
                <div class="alert alert-info">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>
                                Anket Sorusu
                            </th>
                            <th>
                                İlişkilendirilen Soru
                            </th>
                            <th>
                                İşlemler
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($egSoru as $eg)
                        <tr>
                            <td>
                                {!! $eg->soru_metni !!}
                            </td>
                            <td>
                                {!! $eg->gizli_soru_metni !!}
                            </td>
                            <td><a href="{{ URL::to('kullanici/anket/gizliSoruSil/'.$eg->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> Sil</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="alert alert-info">
                    <form class="form-horizontal form-bordered" method="post" action="{{ URL::to('kullanici/anket/gizliSoru/'.$anket->id) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Anket Sorusu</label>
                            <div class="col-md-9">
                                <select class="form-control" name="soru">
                                    @foreach($sorular as $soru)
                                        <option value="{{ $soru->id }}">{{ $soru->soru_metni }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">İlişkilendirilecek Soru Metni</label>
                            <div class="col-md-9">
                                <textarea name="gSoru"></textarea>
                                <script>
                                    CKEDITOR.replace( 'gSoru' );
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3"></div>
                            <div class="col-md-9"><button type="submit" class="btn btn-success">Soruyu Ekle</button></div>

                        </div>
                    </form>
                    </div>
                </div>
        </div>
    </div>
@endsection