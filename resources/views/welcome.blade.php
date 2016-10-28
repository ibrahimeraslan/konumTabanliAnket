@extends('layouts.app')

@section('content')

    <div role="main" class="main">
        <div class="slider-container rev_slider_wrapper">
            <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"gridwidth": 1170, "gridheight": 500}'>
                <ul>
                    <li data-transition="fade">
                        <img src="{{ asset('template/img/home/anket1.jpg') }}"
                             alt=""
                             data-bgposition="center center"
                             data-bgfit="cover"
                             data-bgrepeat="no-repeat"
                             class="rev-slidebg" data-no-retina>


                        <div class="tp-caption main-label"
                             data-x="685"
                             data-y="190"
                             data-start="1800"
                             data-whitespace="nowrap"
                             data-transform_in="y:[100%];s:500;"
                             data-transform_out="opacity:0;s:500;"
                             data-mask_in="x:0px;y:0px;">PARA KAZAN</div>

                        <div class="tp-caption bottom-label"
                             data-x="685"
                             data-y="250"
                             data-start="2000"
                             data-transform_idle="o:1;"
                             data-transform_in="y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;s:600;e:Power4.easeInOut;"
                             data-transform_out="opacity:0;s:500;"
                             data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                             data-splitin="chars"
                             data-splitout="none"
                             data-responsive_offset="on"
                             data-elementdelay="0.05">Sizde uygun anketleri doldurarak para kazanın.</div>

                    </li>
                    <li data-transition="fade">
                        <img src="{{ asset('template/img/home/anket2.jpg') }}"
                             alt=""
                             data-bgposition="center center"
                             data-bgfit="cover"
                             data-bgrepeat="no-repeat"
                             class="rev-slidebg" data-no-retina>


                        <div class="tp-caption main-label"
                             data-x="685"
                             data-y="190"
                             data-start="1800"
                             data-whitespace="nowrap"
                             data-transform_in="y:[100%];s:500;"
                             data-transform_out="opacity:0;s:500;"
                             data-mask_in="x:0px;y:0px;">ARAŞTIRMA YAP</div>

                        <div class="tp-caption bottom-label"
                             data-x="685"
                             data-y="250"
                             data-start="2000"
                             data-transform_idle="o:1;"
                             data-transform_in="y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;s:600;e:Power4.easeInOut;"
                             data-transform_out="opacity:0;s:500;"
                             data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                             data-splitin="chars"
                             data-splitout="none"
                             data-responsive_offset="on"
                             data-elementdelay="0.05">Firmanız için en doğru sonuçlara ulaşın.</div>

                    </li>
                </ul>
            </div>
        </div>
        <div class="home-intro" id="home-intro">
            <div class="container">

                <div class="row">
                    <div class="col-md-8">
                        <p>
                            <em>Trpoll </em> ile kaliteli anketler oluşturarak hedef kitlenize ulaşabilirsiniz.
                            <span>Fikirlerinizi belirterek para kazanabilir ve paypal hesabınıza aktarabilirsiniz.</span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="get-started">
                            <a href="#" class="btn btn-lg btn-primary">Hemen Başlayın</a>
                            <div class="learn-more">veya <a href="index.html">yardım alın.</a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">

            <div class="row center">
                <div class="col-md-12">
                    <h1 class="mb-sm word-rotator-title">
                        Trpoll ile
                        <strong class="inverted">
									<span class="word-rotate" data-plugin-options='{"delay": 2000, "animDelay": 300}'>
										<span class="word-rotate-items">
											<span>anketler oluşturabilirsiniz</span>
											<span>anketlere katılarak para kazanabilirsiniz</span>
											<span>paypal hesabınıza ödeme alabilirsiniz</span>
										</span>
									</span>
                        </strong>
                    </h1>
                    <p class="lead">
                        Trpoll, size uygun anketleri sizin için sunar. Bu anketlere katılarak tamamen doldurmanız gerekmektedir. Gerekli kontrollerden sonra hesabınıza anket ücreti yansıtılmaktadır. Bakiyeniz <b>50TL</b> ulaştıktan sonra paypal hesabınıza ödeme alabilirsiniz.
                    </p>
                </div>
            </div>

        </div>


        <section class="section section-primary mb-none">
            <div class="container">
                <div class="row">
                    <div class="counters counters-text-light">
                        <div class="col-md-3 col-sm-6">
                            <div class="counter">
                                <strong data-to="19000" data-append="+">1200+</strong>
                                <label>Kullanıcı</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="counter">
                                <strong data-to="150">150</strong>
                                <label>Firma veya Kuruluş</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="counter">
                                <strong data-to="352">352</strong>
                                <label>Oluşturulmuş Anket</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="counter">
                                <strong data-to="178" data-append="+">178</strong>
                                <label>Yapılan Ödeme</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="home-concept">
            <div class="container">

                <div class="row center">
                    <span class="sun"></span>
                    <span class="cloud"></span>
                    <div class="col-md-2 col-md-offset-1">
                        <div class="process-image appear-animation" data-appear-animation="bounceIn">
                            <img src="{{ asset('template/img/home/banner/uye-ol.png') }}" alt="" />
                            <strong>Hesap Oluştur</strong>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="process-image appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="200">
                            <img src="{{ asset('template/img/home/banner/profil-bilgilerini-doldur.png') }}" alt="" />
                            <strong>Bilgileri Doldur</strong>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="process-image appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="400">
                            <img src="{{ asset('template/img/home/banner/anketlere-katilim-goster.png') }}" alt="" />
                            <strong>Anketlere Katıl</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="project-image">
                            <div id="fcSlideshow" class="fc-slideshow">
                                <ul class="fc-slides">
                                    <li><a href="portfolio-single-project.html"><img class="img-responsive" src="{{ asset('template/img/home/banner/parakazan.jpg') }}" alt="" /></a></li>
                                </ul>
                            </div>
                            <strong class="our-work">Para Kazan</strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>

@endsection