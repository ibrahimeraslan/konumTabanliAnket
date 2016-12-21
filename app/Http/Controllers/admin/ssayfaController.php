<?php

namespace App\Http\Controllers\admin;

use App\page\SistemSayfa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use Input;

class ssayfaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ssayfa',['sayfalar'=>SistemSayfa::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rules = array(
            'ssayfa_adi'  => 'required|min:3|max:250',
            'ssayfa_metni' => 'required|min:10',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator);
        } else {
            SistemSayfa::create([
                'sayfa_adi' => Input::get('ssayfa_adi'),
                'sayfa_metni' => Input::get('ssayfa_metni'),
            ]);
            return Redirect::back()
                ->with('status','Sayfa başarıyla eklendi.');
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
        return SistemSayfa::where('id',$id)->first();
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
            'ssayfaadiDuzenle'  => 'required|min:3|max:250',
            'ssayfametniDuzenle' => 'required|min:10',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator);
        } else {
            SistemSayfa::where('id',$id)->update([
                'sayfa_adi' => Input::get('ssayfaadiDuzenle'),
                'sayfa_metni' => Input::get('ssayfametniDuzenle'),
            ]);
            return Redirect::back()
                ->with('status','Sayfa Başarıyla Güncellenmiştir.');
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
        SistemSayfa::where('id',$id)->delete();
        return Redirect::back()
            ->with('status','Sayfa Başarıyla Silinmiştir.');
    }
}
