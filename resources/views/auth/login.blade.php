@extends('layouts.app')

@section('content')


    <div role="main" class="main">

        <div class="container">

            <div class="row">
                <div class="col-md-12">

                    <div class="featured-boxes">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md">Oturum Aç</h4>

                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                            {{ csrf_field() }}

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>E-mail Adresiniz</label>
                                                        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control input-lg">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Şifreniz</label>
                                                        <input id="password" type="password" class="form-control input-lg" name="password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 ">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="remember"> Beni Hatırla
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input type="submit" value="Hesabımı Oluştur" class="btn btn-primary pull-left mb-xl" data-loading-text="Loading...">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <h4 class="text-uppercase">neden <strong>trpoll</strong>?</h4>

                                        <ul class="list list-icons list-primary list-borders">
                                            <li><i class="fa fa-check"></i> Sistem</li>
                                           <li><i class="fa fa-check"></i> Fusce sit amet orci quis arcu vestibulum vestibulum.</li>
                                            <li><i class="fa fa-check"></i> Fusce sit amet orci quis arcu vestibulum vestibulum.</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
