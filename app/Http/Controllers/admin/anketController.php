<?php

namespace App\Http\Controllers\admin;

use App\Anket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Validator;
use DB;
use Input;

class anketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anketler = Anket::join('users','users.id','=','anketler.uye_id')
            ->select('anketler.*','users.name as name')
            ->paginate(15);
        return view('admin.anket',['anketler'=>$anketler]);
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
        if(!Input::get('durum')){
            return Redirect::back()->withErrors("Hatalı işlem yapıldı");
        }elseif(Input::get('durum')==1){
            Anket::where('id',$id)->update(['anket_durum'=>0]);
            return Redirect::back()->with('status','İşleminiz başarıyla gerçekleştirildi.');
        }elseif(Input::get('durum')==2){
            Anket::where('id',$id)->update(['anket_durum'=>1]);
            return Redirect::back()->with('status','İşleminiz başarıyla gerçekleştirildi.');
        }else{
            return Redirect::back()->withErrors("Hatalı işlem yapıldı");
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
        Anket::where('id',$id)->delete();
        DB::table('anket_kurallari')->where('anket_id',$id)->delete();
        DB::table('doldurulmus_anketler')->where('anket_id',$id)->delete();
        return Redirect::back()
            ->with('status','Anket Başarıyla Silinmiştir.');
    }
}
