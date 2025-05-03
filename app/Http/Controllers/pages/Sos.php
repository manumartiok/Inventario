<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\So;
use Illuminate\Support\Facades\Hash;

class Sos extends Controller
{
  public function index()
  {
    $sos=So::all();
    return view('content.pages.sos',['sos'=>$sos]);
  }

  public function create()
  {
    return view('content.pages.sos-create');
  }

  public function store(Request $request){
  //   $validator=$request->validate([
  //     'name' => 'required,
  // ]);
    $sos= new So();
    $sos->name=$request->name;
    $sos->description=$request->description;
    $sos->version=$request->version;
    $sos->save();
    return redirect()->route('pages-sos');

  }

  public function show($sos_id){
    $sos=So::find($sos_id);
    return view('content.pages.sos-show' ,['sos'=>$sos]);
  }

  public function update(Request $request){
    $sos = So::find($request->sos_id);
    $sos->name=$request->name; //"name" es el mismo nombre que puse en el valor de name del input en la tabla de show
    $sos->version=$request->version;
    $sos->description=$request->description;
    $sos->save();
    return redirect()->route('pages-sos');
  }

    public function destroy($sos_id){
    $sos= So::find($sos_id);
    $sos->delete();
    return redirect()->route('pages-sos');
  }

  public function switch($sos_id){
    $sos=So::find($sos_id);
    $sos->active= !$sos->active;
    $sos->save();
    return redirect()->route('pages-sos');
  }
}
