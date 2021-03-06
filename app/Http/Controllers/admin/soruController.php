<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\FunctionController;
use App\Http\Middleware\admin;
use App\UyelikSoru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Redirect;
use DB;

class soruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.soru',['sorular'=>UyelikSoru::all(),'FunctionController'=>new FunctionController()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rules = array(
            'soru_metni'  => 'required|min:5',
            'soru_tipi' => 'required|numeric',
            'soru_secenek_tipi' => 'required|numeric',
            'secenek' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator);
        } else {
            $durum = UyelikSoru::create([
                'soru_metni'=>Input::get('soru_metni'),
                'tip'=>Input::get('soru_tipi'),
                'soru_tip'=>Input::get('soru_secenek_tipi'),
            ]);
            if(!$durum){
                return Redirect::back()
                    ->withErrors("Hat Oluştu");
            }else{
                $sec = Input::get('secenek');
                foreach ($sec as $secenek){
                    DB::table('uyelik_soru_secenekleri')->insert([
                        'soru_id'=>$durum->id,
                        'cevap_metni'=>$secenek
                    ]);
                }
                return Redirect::back()->with('status','İşleminiz Başarıyla Gerçekleştirildi.');
            }
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UyelikSoru::where('id',$id)->delete();
        DB::table('uyelik_soru_secenekleri')->where('soru_id',$id)->delete();
        return Redirect::back()->with('status','İşleminiz Başarıyla Gerçekleştirildi.');
    }
}
