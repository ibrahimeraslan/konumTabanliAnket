<?php

namespace App\Http\Controllers\admin;

use App\Meslek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Redirect;

class meslekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.meslek',['meslekler'=>Meslek::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rules = array(
            'meslek_metni'  => 'required|min:3',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator);
        } else {
            Meslek::create([
                'meslek_adi'=>Input::get('meslek_metni')
            ]);
            return Redirect::back()->with('status','İşleminiz Başarıyla Gerçekleştirilmiştir.');
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
        return Meslek::where('id',$id)->first();
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
        Meslek::where('id',$id)->update([
            'meslek_adi'=>Input::get('meslek_metni')
        ]);
        return Redirect::back()->with('status','İşleminiz Başarıyla Gerçekleştirilmiştir.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Meslek::where('id',$id)->delete();
        return Redirect::back()->with('status','İşleminiz Başarıyla Gerçekleştirilmiştir.');
    }
}
