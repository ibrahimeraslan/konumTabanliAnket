@extends('layouts.app')

@section('content')
    <div role="main" class="main">

    <div class="container">

        <h2><strong>Trpoll</strong> Sık Sorulan Sorular</h2>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="toggle toggle-quaternary" data-plugin-toggle data-plugin-options='{ "isAccordion": true }'>
                    @foreach($sorular as $soru)

                        <section class="toggle">
                                <label>{{ $soru->soru_metni }}</label>
                                <div class="toggle-content">
                                    {!! $soru->soru_cevabi !!}
                                </div>
                        </section>
                    @endforeach
                </div>

            </div>

        </div>

    </div>

</div>
    @endsection