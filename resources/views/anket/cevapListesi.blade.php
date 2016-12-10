@extends('layouts.app')
@section('content')
    <div class="container">
        <h4>{{ $uye->name }} üyesinin anketinize verdiği cevaplar</h4>
        @foreach($sorular as $soru)
        <div class="anketSorulari">
            {!! $soru->soru_metni !!}
            <hr/>
            {!! $FunctionController::cevaplar($dAnket,$uye->id,$soru->id,$soru->tip) !!}
        </div>
            @endforeach
    </div>
@endsection
<style>
    img {
        max-width: 100px;
        height:auto !important;
    }
</style>