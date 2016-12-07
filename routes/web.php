<?php
Route::get('/', 'WelcomeController@anaSayfa');

Auth::routes();

Route::get('/home', function (){
    if(Auth::guest()) return Redirect::to('login');
    else return Redirect::to('kullanici/panel');
});
Route::get('/register', 'Auth\RegisterController@yeniUye');

//Sistem de kullanılacak sayfalar page ön tagı ile route oluşturuldu
Route::group(['prefix' => 'page'], function()
{
    Route::get('/iletisim', 'page\IletisimController@index');
    Route::post('/iletisim', 'page\IletisimController@kayitEkle');
    Route::get('/sss', 'page\SssController@index');
    Route::get('/show/{id}', 'page\SistemSayfalariController@index');

});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'kullanici'], function()
    {
        Route::get('/panel', 'PanelController@durumKontrol');
        Route::post('/panel', 'PanelController@uyelikCevaplariIsle');
        Route::post('/panel/bilgiGuncelle', 'PanelController@bilgiGuncelle');
        Route::post('/anketGetir', 'PanelController@anketGetir');
        Route::post('/tipDegistir', 'PanelController@tipDegistir');
        Route::get('/ayarlar', 'AyarController@index');
        Route::get('/start/{id}', 'anket\AnketController@index');
        Route::post('/start/{id}', 'anket\AnketController@anketCevabiEkle');
        Route::get('/anketOlustur', 'anket\AnketController@anketOlustur');
        Route::post('/anketOlustur', 'anket\AnketController@anketIsle');
        Route::post('/paraTransfer', 'anket\AnketController@paraTransfer');
        Route::group(['prefix' => 'anket'], function()
        {
            Route::get('/anketDurumu/{durum}/{id}', 'anket\AnketController@anketDurumu');
            Route::get('/kuralIslemleri', 'anket\AnketController@kuralIslemleri');
            Route::get('/gizliSoru/{id}', 'anket\AnketController@gizliSoru');
            Route::post('/gizliSoru/{id}', 'anket\AnketController@gizliSoruEkle');
            Route::get('/gizliSoruSil/{id}', 'anket\AnketController@gizliSoruSil');
            Route::get('/cevapGoster/{id}', 'anket\AnketController@cevapGoster');
            Route::post('/cevapGoster', 'anket\AnketController@cevapListele');
            Route::post('/cevapDurumla', 'anket\AnketController@cevapDurumla');
            Route::get('/anketBilgiDuzenle/{id}', 'anket\AnketController@anketBilgiDuzenle');
            Route::post('/anketBilgiDuzenle/{id}', 'anket\AnketController@anketBilgiGuncelle');
            Route::get('/soruDuzenle', 'anket\AnketController@soruDuzenle');
            Route::get('/soruSecenekSil', 'anket\AnketController@soruSecenekSil');
            Route::get('/ayrintiGoster/{id}', 'anket\AnketController@ayrintiGoster');
        });

        Route::group(['prefix' => 'ayarlar'], function()
        {
            Route::get('/', 'AyarController@index');
            Route::post('/anaBilgiler', 'AyarController@anaBilgiler');
            Route::post('/sifreDegistir', 'AyarController@sifreDegistir');
            Route::get('/hesapSil/{mail}', 'AyarController@hesapSil');
        });
    });
});

Route::group(['prefix' => 'api'], function()
{
    Route::get('/login', 'api\UserController@login');
    Route::get('/register', 'api\UserController@register');
    Route::get('/forgetpassword', 'api\UserController@forgetPassword');
    Route::group(['middleware' => 'apiToken'], function () {
        Route::get('/bilgiCek', 'api\UserController@bilgiCek');
        Route::get('/sifreDegistir', 'api\UserController@sifreDegistir');
        Route::get('/bilgiDegistir', 'api\UserController@bilgiDegistir');
        Route::get('/sistemAyarCek', 'api\UserController@sistemAyarCek');
        Route::get('/katilinanAnketler', 'api\AnketController@katilinanAnketler');
        Route::get('/iletisim', 'api\UserController@iletisim');
        Route::get('/sistemSayfa/{id}', 'api\UserController@sistemSayfa');
        Route::get('/kazanc', 'api\UserController@kazanc');
    });

});


Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', 'admin\AdminController@index');
    });
});

Route::get('/{any}', function ($any) {return view('errors.404');})->where('any', '.*');