@extends('layouts.app')

@section('content')
    <div role="main" class="main">

        <div class="container">

            <div class="row">
                <div class="col-md-6">

                    <h2 class="mb-sm mt-sm"><strong>Trpoll</strong> İletişim</h2>
                    <form id="contactForm" action="{{ URL::to('page/iletisim') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label>Adınız ve Soyadınız *</label>
                                    <input type="text" value="" maxlength="100" class="form-control" name="isim" id="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Email Adresiniz *</label>
                                    <input type="email" value=""  maxlength="100" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Mesajınızın Konusu *</label>
                                    <input type="text" value=""  maxlength="100" class="form-control" name="konu" id="subject" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Mesajınız *</label>
                                    <textarea maxlength="5000" rows="10" class="form-control" name="mesaj" id="message" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" value="Mesajımı Gönder" class="btn btn-primary btn-lg mb-xlg">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">

                    <h4 class="heading-primary mt-lg"><strong>Trpoll</strong> İletişim</h4>
                    <p>Yandaki iletişim formu tüm kullanıcılarımızın görüş, öneri, istek ve sorunlarını tarafımıza iletmeleri için oluşturulmuştur.<br/>Lütfen tüm alanları eksiksiz olarak doldurarak tarafımıza iletiniz.<br/>
                        Göndermiş olduğunuz mesajlar iş günleri hesaplanmak şartı ile maximum <strong>48 saat</strong> içinde cevaplanacaktır.
                    </p>

                    <hr>

                    <h4 class="heading-primary"><strong>Bilgilerimiz</strong></h4>
                    <ul class="list list-icons list-icons-style-3 mt-xlg">
                        <li><i class="fa fa-map-marker"></i> <strong>Address:</strong> {{ $ayarlar->site_adres }}</li>
                        <li><i class="fa fa-phone"></i> <strong>Phone:</strong> {{ $ayarlar->site_tel }}</li>
                        <li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:{{ $ayarlar->site_mail }}">{{ $ayarlar->site_mail }}</a></li>
                    </ul>
                    <p class="center">
                    <ul class="header-social-icons social-icons hidden-xs" style="margin:0;">
                        <li class="social-icons-facebook"><a href="{{ $ayarlar->facebook }}" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li class="social-icons-twitter"><a href="{{ $ayarlar->twitter }}" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li class="social-icons-youtube"><a href="{{ $ayarlar->youtube }}" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                    </p>



                </div>

            </div>

        </div>

    </div>
@endsection
