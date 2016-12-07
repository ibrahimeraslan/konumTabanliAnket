@extends('layouts.nobar')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4 zamanIlk">Geçen Zaman: <div id="zaman"></div></div>
        <div class="col-md-12 alert alert-default">
            <div class="center"><h4>{{ $anket->anket_adi }}</h4></div>
            <form method="post" action="{{ URL::to('kullanici/start/'.$id) }}">
                {{ csrf_field() }}
            <div class="col-md-12">
                <div class="tabs tabs-quaternary">
                    <ul class="nav nav-tabs pageList">
                        <?php
                            $liste = ceil(count($sorular) / $anket->anket_sayfa_sayisi);
                            for($i=0;$i<$liste;$i++){
                        ?>
                        <li @if($i==0) class="active" @endif>
                            <a href="#anketSira{{ $i+1 }}" data-toggle="tab"><i class="fa fa-globe"></i> Adım {{ $i+1 }}</a>
                        </li>
                            <?php
                            }
                            ?>

                    </ul>
                    <div class="tab-content">
                        <div id="anketSira1" class="tab-pane active">
                        <?php $i=1; $j=0; $k=1; $x=1;
                                $gs = array();
                            for($s = 0; $s<count($gizliSorular);$s++){
                                $gs[$s] = rand(1,count($sorular));
                            }
                            ?>
                        @foreach($sorular as $soru)
                            <div class="anketSorulari">
                                {!! $soru->soru_metni !!}
                                {!!  $FunctionController::anketDoldurSecenek($soru->tip,$soru->id) !!}
                                </div>
                            <?php
                                $j++;
                                    for($l=0;$l<count($gs);$l++){
                                        if($gs[$l]==$k){
                                            $y=0;
                                            $result = json_decode($gizliSorular, true);
                                            ?>
                                    <div class="anketSorulari">
                                            {!! $result[$l]['gizli_soru_metni'] !!}
                                            {!! $FunctionController::anketDoldurSecenek($result[$l]['tip'],$result[$l]['soru_id'],1) !!}
                                        </div>
                                <?php
                                        }
                                    }
                                    $k++;
                                    if($j==$anket->anket_sayfa_sayisi){
                                    $i++;
                                    echo '</div><div id="anketSira'.$i.'" class="tab-pane">';
                                    $j=0;

                                }
                                ?>
                        @endforeach
                    </div>
                        <button class="btnYolla pull-right btn btn-success">Cevaplarımı Gönder</button>
                        <div class="clearfix"></div>
                </div>
            </div>

        </div>
                </form>
    </div>
</div>
    <style>
        body {
            background:url(http://register.extension.iastate.edu/images/display/background-overlay-final.png);
        }

    </style>
<script>
    $(window).load(function(){
        zamanBaslat();
        imgToLight();
    });

</script>
    @endsection
<style>
    img {
        max-width:100px !important;
        height: auto !important;
    }
</style>