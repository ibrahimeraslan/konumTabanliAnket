@extends('layouts.app')

@section('content')
    <div role="main" class="main">

    <div class="container">

        <h2><strong>Trpoll</strong> Sık Sorulan Sorular</h2>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="toggle toggle-quaternary" data-plugin-toggle>
                    @foreach($sorular as $soru)
                        <section class="toggle">
                            <label>{{ $soru->soru_metni }}</label>
                            <p>{{ $soru->soru_cevabi }}</p>
                        </section>
                    @endforeach
                </div>

            </div>

        </div>

    </div>

</div>
    @endsection