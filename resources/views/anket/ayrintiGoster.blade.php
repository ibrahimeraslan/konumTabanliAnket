@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<div class="container">
    <h4>"{{ $anket->anket_adi }}" için bilgiler</h4>
    <div class="alert alert-info">
    <h4>Katılım Durumu</h4>
        <div id="doldurma" class="graph"></div>
    <script>
        Morris.Bar({
            element: 'doldurma',
            data: [
                {device: 'Katılım Limiti', Miktar: {{ $anket->anket_limit }} },
                {device: 'Katılım Sayısı', Miktar: {{ $anket->anket_katilim_sayisi }} },
            ],
            xkey: 'device',
            ykeys: ['Miktar'],
            labels: ['Miktar'],
            barRatio: 0.4,
            xLabelAngle: 35,
            hideHover: 'auto'
        });
    </script>
    </div>
</div>
@endsection