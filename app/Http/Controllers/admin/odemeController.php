<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Input;

class odemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $istekler = DB::table('para_aktarim_istekleri')->join('users','users.id','=','para_aktarim_istekleri.user_id')
            ->select('para_aktarim_istekleri.*','users.name as name')
            ->paginate(15);
        return view('admin.odeme',['istekler'=>$istekler]);
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
            DB::table('para_aktarim_istekleri')->where('id',$id)->update([
                'durum'=>1,
                'mesaj'=>Input::get('mesaj')
            ]);
            return Redirect::back()->with('status','İşleminiz başarıyla gerçekleştirildi.');
        }elseif(Input::get('durum')==2){
            DB::table('para_aktarim_istekleri')->where('id',$id)->update([
                'durum'=>2
            ]);
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
        //
    }
}
