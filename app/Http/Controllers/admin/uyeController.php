<?php

namespace App\Http\Controllers\admin;

use App\DoldurulmusAnket;
use App\SistemAyar;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Validator;
use DB;

class uyeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.uye',['uyeler'=>User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(User::where('id',$id)->first()->tip == 1){
            $string = "<h4>Katıldığım Anketler</h4><table class=\"table table-condensed\">
                    <tbody><tr>
                        <th style=\"width: 10px\">#</th>
                        <th>Anket Adı</th>
                        <th>Ücret</th>
                        <th>Durum</th>
                    </tr>";
            $doldurulmusAnket = DB::table('doldurulmus_anketler')
                ->join('anketler', 'anketler.id', '=', 'doldurulmus_anketler.anket_id')
                ->where('doldurulmus_anketler.uye_id', '=', $id)
                ->get();

            foreach ($doldurulmusAnket as $d){
                $ucret = $d->anket_ucret-($d->anket_ucret*(SistemAyar::first()->ucret_kesintisi/100));
                if($d->durum==0)
                    $durum = '<span class="label label-warning">Kontrol Ediliyor</span>';
                elseif($d->durum==1)
                    $durum = '<span class="label label-danger">Red Edildi!</span>';
                elseif($d->durum==2)
                    $durum = '<span class="label label-tertiary">Onaylandı</span>';
                $string .= '<tr><td>'.$d->id.'</td><td>'.$d->anket_adi.'</td><td>'.$ucret.'TL</td><td>'.$durum.'</td></tr>';
            }
        }else{
            $string = "<h4>Oluşturduğum Anketler</h4><table class=\"table table-condensed\">
                    <tbody><tr>
                        <th style=\"width: 10px\">#</th>
                        <th>Anket Adı</th>
                        <th>Katılım Limiti</th>
                        <th>Doldurma Başına Ücret</th>
                        <th>Katılmış Kişi Sayısı</th>
                        <th>Anket Durumu</th>
                    </tr>";
            $anketler = DB::table('anketler')->where('uye_id',$id)->get();

            foreach ($anketler as $d){

                if($d->anket_durum==0)
                    $durum = '<span class="label label-danger">Yayında değil</span>';
                elseif($d->anket_durum==1)
                    $durum = '<span class="label label-success">Yayında</span>';

                $string .= '<tr><td>'.$d->id.'</td><td>'.$d->anket_adi.'</td><td>'.$d->anket_limit.'</td><td>'.$d->anket_ucret.'TL</td><td>'.$d->anket_katilim_sayisi.'</td><td>'.$durum.'</td></tr>';
            }
        }

        return $string;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'yetki'  => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator);
        } else {
            if(Input::get('yetki')==1){
                User::where('id',$id)->update([
                    'is_admin'=>0
                ]);
                return Redirect::back()
                    ->with('status','Yetki başarıyla ayarlanmıştır.');
            }else if(Input::get('yetki')==2){
                User::where('id',$id)->update([
                    'is_admin'=>1
                ]);
                return Redirect::back()
                    ->with('status','Yetki başarıyla ayarlanmıştır.');
            }
            else{
                return Redirect::back()
                    ->withErrors("Hatalı işlem");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        DoldurulmusAnket::where('uye_id',$id)->delete();
        DB::table('para_aktarim_istekleri')->where('user_id',$id)->delete();
        DB::table('uyelik_soru_cevaplari')->where('uye_id',$id)->delete();

        return Redirect::back()
            ->with('status','Üye Başarıyla Silinmiştir.');
    }
}
