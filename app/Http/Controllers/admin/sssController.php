<?php

namespace App\Http\Controllers\admin;

use App\SSS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Redirect;

class sssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sss',['sorular'=>SSS::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rules = array(
            'soru_metni'  => 'required|min:3|max:250',
            'soru_cevabi' => 'required|min:10',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator);
        } else {
            SSS::create([
                'soru_metni' => Input::get('soru_metni'),
                'soru_cevabi' => Input::get('soru_cevabi'),
            ]);
            return Redirect::back()
                ->with('status','Soru Başarıyla Eklenmiştir.');
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
        return SSS::where('id',$id)->first();
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
            'soruDuzenMetin'  => 'required|min:3|max:250',
            'soruDuzenCevap' => 'required|min:10',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator);
        } else {
            SSS::where('id',$id)->update([
                'soru_metni' => Input::get('soruDuzenMetin'),
                'soru_cevabi' => Input::get('soruDuzenCevap'),
            ]);
            return Redirect::back()
                ->with('status','Soru Başarıyla Güncellenmiştir.');
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
        SSS::where('id',$id)->delete();
        return Redirect::back()
            ->with('status','Soru Başarıyla Silinmiştir.');
    }
}
