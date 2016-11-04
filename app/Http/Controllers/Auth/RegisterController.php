<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Meslek;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/kullanici/panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'isim' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'sifre' => 'required|min:6|confirmed',
            'dogum_tarihi' => 'required',
            'meslek' => 'required|numeric',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['isim'],
            'email' => $data['email'],
            'password' => bcrypt($data['sifre']),
            'avatar' => 'logo.png',
            'dogum_tarihi' => $data['dogum_tarihi'],
            'meslek_id' => $data['meslek'],
            'tip' => 0,
            'durum' => 0,
            'api_token' => str_random(64),
        ]);
    }
    public function yeniUye(){
        return view('auth\register',['meslekler' =>  Meslek::all()]);
    }
}
