<h4>Katılabileceğim Anketler</h4>
@if(count($veriler)<1)
    <div class="alert alert-warning">
        Size uygun bir anket bulunamadı.
    </div>
@else
    <table class="table table-hover">
        <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                Anket İsmi
            </th>
            <th>
                Kazanç Tutarı
            </th>
            <th>
                Ankete Katıl
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($veriler as $veri)
            @if($FunctionController::doldurmusMu($veri->id)<1)
            <tr>
                <td>
                    {{ $veri->id }}
                </td>
                <td>
                    {{ $veri->anket_adi }}
                </td>
                <td>
                    {{ $veri->anket_ucret-($veri->anket_ucret*($ayarlar->ucret_kesintisi/100)) }} <i class="fa fa-try"></i>
                </td>
                <td>
                   <a href="{{ URL::to('kullanici/start/'.$veri->id.'') }}" target="_blank" class="btn btn-xs btn-tertiary"><i class="fa fa-play"></i> Anketi Başlat</a>
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endif