<?php
Route::get('/', 'HomeController@anaSayfa');

Auth::routes();

Route::get('/home', 'HomeController@index');
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
        Route::post('/anketGetir', 'PanelController@anketGetir');
        Route::post('/tipDegistir', 'PanelController@tipDegistir');
        Route::get('/ayarlar', 'AyarController@index');


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
    });

});
Route::get('/{any}', function ($any) {return view('errors.404');})->where('any', '.*');